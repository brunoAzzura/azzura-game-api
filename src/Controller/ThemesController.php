<?php
namespace App\Controller;

use App\Entity\GameType;
use App\Entity\PuzzleGame;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\Theme;
use App\Entity\Question;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\EntityMerger\EntityMerger;
use App\Entity\ThemeDraw;

// /**
//  * @Security("is_authenticated()")
//  */
class ThemesController extends AbstractController{

    use ControllerTrait;


    /**
     * @var EntityMerger
     */
    private $entityMerger;

    public function __construct(
        EntityMerger $entityMerger
    ) {
        $this->entityMerger = $entityMerger;
    }

    /**
     * @View(serializerGroups={"get-themes"})
     */
    public function getThemesAction(){
        $themes = $this->getDoctrine()
        ->getRepository(Theme::class)
        ->findAll();

        return $themes;
    }

    /**
     * @View(serializerGroups={"get-theme"})
     */
    public function getThemeAction($id){
        $theme = $this->getDoctrine()
        ->getRepository(Theme::class)
        ->find($id);

        return $theme;
    }

    /**
     * @Rest\Post("/uploadFilesTheme")
     * @Security("is_granted('ROLE_ADMIN')")
     * @View()
     */
    public function postUploadFilesTheme(Request $request){
        // todo: methode a perfectionner
        $fileSystem = new Filesystem();
        if(!$fileSystem->exists('./img/theme')){
            $fileSystem->mkdir('./img/theme');
        }

        $themeId = $_REQUEST['theme_id'];
        
        $em = $this->getDoctrine()->getManager();
        $theme = $em->getRepository(Theme::class)
                    ->find($themeId);

        $var = $_REQUEST['var'];

        $fileInfos = $_FILES['image'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];
        $timer = sprintf("%d", microtime(true) * 1000000);

        switch ($var) {
            case "image_path":
                $fileName = "theme_".$timer.".".$type;
                $oldPath = $theme->getThemeDraw()->getImagePath();
                $theme->getThemeDraw()->setImagePath("img/theme/".$fileName);
                break;
            case "image_success_path":
                $fileName = "theme_".$timer."_happy.".$type;
                $oldPath = $theme->getThemeDraw()->getImageSuccessPath();
                $theme->getThemeDraw()->setImageSuccessPath("img/theme/".$fileName);
                break;
            case "image_error_path":
                $fileName = "theme_".$timer."_sad.".$type;
                $oldPath = $theme->getThemeDraw()->getImageErrorPath();
                $theme->getThemeDraw()->setImageErrorPath("img/theme/".$fileName);
                break;
        }

        if( $oldPath !== '' && $oldPath !== null && $fileSystem->exists('./'.$oldPath)) {
            $fileSystem->remove('./'.$oldPath);
        }

        $filePath = "./img/theme/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);
        
        $em->flush();

        // return $theme->getThemeDraw();
        return ["img_path" => "img/theme/".$fileName];
    }





    /**
     * @Rest\NoRoute()
     * @View(serializerGroups={"get-theme"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("modifiedTheme", converter="fos_rest.request_body")
     */
    public function patchThemesAction(?Theme $theme, Theme $modifiedTheme){

        if(null === $theme){
            return $this->view(null, 404);
        }

        // Merge entities
        $this->entityMerger->merge($theme, $modifiedTheme);   

        $em = $this->getDoctrine()->getManager();
        $em->persist($theme);
        $em->flush();

        return $theme;
    }

    /**
     * @Rest\NoRoute()
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("gameType", converter="fos_rest.request_body")
     */
    public function patchThemeGameTypeAction(?Theme $theme, GameType $gameType){

            $em = $this->getDoctrine()->getManager();

            if($theme->getQuestions()) {
                foreach($theme->getQuestions() as $question) {
                    $em->remove($question);
                    $em->flush();
                }
            }
            if($theme->getMemoryCards()) {
                foreach($theme->getMemoryCards() as $memoryCard) {
                    $em->remove($memoryCard);
                    $em->flush();
                }
            }
            if($theme->getPuzzleGame()){
                $theme->setPuzzleGame(null);
                $em->persist($theme);
                $em->flush();
            }

            if ($gameType->getId() === 3) {
                $puzzleGame = new PuzzleGame();
                $puzzleGame->setNbCases(3);
                $puzzleGame->setTimeLimit(240);
                $puzzleGame->setImagePuzzlePath('');
                $em->persist($puzzleGame);
                $em->flush();
                $theme->setPuzzleGame($puzzleGame);
            }

            // $em->merge($gameType); doesnt work ... persist, merge, nothing... ->
            
            $gameType = $this->getDoctrine()
            ->getRepository(GameType::class)
            ->find($gameType->getId());

            $theme->setGameType($gameType);

            $em->persist($theme);
            $em->flush();

            return $gameType;
        
    }

    /**
     * @Rest\NoRoute()
     * @View(serializerGroups={"get-theme"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("modifiedThemeDraw", converter="fos_rest.request_body")
     */
    public function patchThemeDrawAction(?ThemeDraw $themedraw, ThemeDraw $modifiedThemeDraw){

        if(null === $themedraw){
            return $this->view(null, 404);
        }

        // Merge entities
        $this->entityMerger->merge($themedraw, $modifiedThemeDraw);   

        $em = $this->getDoctrine()->getManager();
        $em->persist($themedraw);
        $em->flush();

        return $themedraw;
    }

        /**
     * @View(serializerGroups={"get-questions"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("modifiedQuestion", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function patchQuestionsAction(?Question $question, Question $modifiedQuestion){
        if(null === $question){
            return $this->view(null, 404);
        }

        // Merge entities
        $this->entityMerger->merge($question, $modifiedQuestion);   

        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return $question;
        
    }

    /**
     * @Rest\Post("/themes")
     * @View(serializerGroups={"get-theme"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("theme", converter="fos_rest.request_body")
     */
    public function postThemesAction(Theme $theme){
        $em = $this->getDoctrine()->getManager();
        // merge to avoid persisting all related entities
        // but theme_draw is correcty persist

        //fonctionne uniquement sur l'id theme_draw_id est dans theme et pas l'inverse ...
        $themeAdded = $em->merge($theme);
        $em->flush();

        return $themeAdded;
    }

    /**
     * @View(serializerGroups={"get-theme-memorycards"})
     */
    public function getThemesMemorycardsAction($id){
        //return all sub-ressources
        $theme = $this->getDoctrine()
        ->getRepository(Theme::class)
        ->find($id);

        return $theme->getMemoryCards();
    }

    /**
     * @View(serializerGroups={"get-theme-puzzle"})
     * @Rest\NoRoute()
     */
    public function getThemePuzzleAction(Theme $theme){
        return $theme->getPuzzleGame();
    }



    /**
     * @View(serializerGroups={"get-questions"})
     */
    public function getThemeQuestionsAction(Theme $theme) 
    {
        return $theme->getQuestions();
    }

    /**
     * @View(serializerGroups={"get-theme"})
     * @ParamConverter("question", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postThemeQuestionsAction(Theme $theme, Question $question) 
    {
        $question->setTheme($theme);
        $em = $this->getDoctrine()->getManager();
        $em->persist($question);

        $em->flush();

        return $question;
    }

     /**
     * @View()
     */
    public function deleteThemesAction(Theme $theme){
        $em = $this->getDoctrine()->getManager();
        // delete also answers in cascade 
        $em->remove($theme);
        $em->flush();
    }
}