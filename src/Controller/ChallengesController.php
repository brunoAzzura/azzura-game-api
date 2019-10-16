<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Entity\Challenge;
use App\EntityMerger\EntityMerger;
use App\Entity\Question;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("is_authenticated()")
 */
class ChallengesController extends AbstractController{

    use ControllerTrait;

    /**
     * @var EntityMerger
     */
    private $entityMerger;

    /**
     * @var ParameterBagInterface
     */
    private $params;
  
    public function __construct(
        ParameterBagInterface $params,
        EntityMerger $entityMerger
    ) {
        $this->params = $params;
        $this->entityMerger = $entityMerger;
    }

    /**
     * @View(serializerGroups={"get-challenges"})
     * 
     */
    public function getChallengesAction(){
        $challenges = $this->getDoctrine()
        ->getRepository(Challenge::class)
        ->findAll();

        return $challenges;
    }

    /**
     * @View(serializerGroups={"get-challenge"})
     */
    public function getChallengeAction(?Challenge $challenge) 
    {
        if( null === $challenge) {
            return $this->view(null, 404);
        }

        return $challenge;
    }

     /**
     * @View(statusCode=201)
     * @Rest\Post("/challenges")
     * @ParamConverter("challenge", converter="fos_rest.request_body")
     */
    public function postChallengesAction(Challenge $challenge)
    {
        // if (count($validationErrors) > 0) {
        //     throw new ValidationException($validationErrors);
        // }

        $em = $this->getDoctrine()->getManager();
        $em->persist($challenge);
        $em->flush();

        return $challenge;
    }

    /**
     * @View(statusCode=201)
     * @ParamConverter("modifiedChallenge", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function patchChallengesAction(?Challenge $challenge, Challenge $modifiedChallenge){
        if(null === $challenge){
            return $this->view(null, 404);
        }
        // , ConstraintViolationListInterface $validationErrors 
        // if(count($validationErrors) > 0) {
        //     throw new ValidationException($validationErrors);
        // }

        // Merge entities
        $this->entityMerger->merge($challenge, $modifiedChallenge);   

        $em = $this->getDoctrine()->getManager();
        $em->persist($challenge);
        $em->flush();

        return $challenge;
    }

    /**
     * @View()
     */
    public function getChallengeQuestionsAction(Challenge $challenge) 
    {
        return $challenge->getQuestions();
    }

    /**
     * @View(statusCode=201)
     * @ParamConverter("question", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postChallengeQuestionsAction(Challenge $challenge, Question $question) 
    {
        $question->setChallenge($challenge);
        $em = $this->getDoctrine()->getManager();
        $em->persist($question);

        $em->flush();

        return $question;
    }

    /**
     * @Rest\NoRoute()
     * @View()
     */
    public function postImageChallengeUploadAction(?Challenge $challenge, Request $request) 
    {
        $file = $request->files->get('challengeImage');

        $fileSystem = new Filesystem();

        $timer = sprintf("%d", microtime(true) * 1000000);

        if(!$fileSystem->exists('./img/challenge')){
            $fileSystem->mkdir('./img/challenge');
        }

        // supprssion de l'ancien fichier s'il existe 
        if($challenge->getImagePresentationPath() !== '' && $challenge->getImagePresentationPath() != null && $fileSystem->exists('./'.$challenge->getImagePresentationPath())) {
            $fileSystem->remove('./'.$challenge->getImagePresentationPath());
        }

        if (!in_array(
            $file->getMimeType(),
            ['image/jpeg', 'image/png', 'image/gif', 'application/octet-stream']
        )) {
            throw new UnsupportedMediaTypeHttpException(
                'File uploaded is not a valid png/jpeg/gif image'
            );
        }

        // Generate a new random filename
        $newFileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->params->get('image_directory').DIRECTORY_SEPARATOR.'challenge', $newFileName);

        $challenge->setImagePresentationPath($this->params->get('image_base_url').'challenge'.DIRECTORY_SEPARATOR.$newFileName);
        
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($challenge);
        $em->flush();

        return $challenge;
    }
}