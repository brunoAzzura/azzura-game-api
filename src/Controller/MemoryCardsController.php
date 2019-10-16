<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\MemoryCard;
use App\Entity\Theme;

// ### security
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class MemoryCardsController extends AbstractController{
    use ControllerTrait;

    /**
     * @View()
     */
    public function getMemorycardsAction(){
        $em = $this->getDoctrine()->getManager();
        $memoryCards = $this->getDoctrine()
        ->getRepository(MemoryCard::class)
        ->findAll();

        return $memoryCards;
    }

    /**
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function postMemorycardsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $fileSystem = new Filesystem();
        if(!$fileSystem->exists('./img/memorycard')){
            $fileSystem->mkdir('./img/memorycard');
        }

        $name = $_REQUEST['name'];
        
        $theme = null;

        if(isset($_REQUEST['themeId'])){
            $themeId = $_REQUEST['themeId'];
            $theme = $this->getDoctrine()
            ->getRepository(Theme::class)
            ->find($themeId);
        }
        

        $cardId = null;
        if(isset($_REQUEST['card_id'])) {
            $cardId = $_REQUEST['card_id'];
            $card = $this->getDoctrine()
            ->getRepository(MemoryCard::class)
            ->find($cardId);
            $card->setName($name);
            $card->setTheme($theme);

            // supprssion de l'ancien fichier s'il existe 
            if($fileSystem->exists('./'.$card->getImagePath())) {
                $fileSystem->remove('./'.$card->getImagePath());
            }
        }
        else{
            $card = new MemoryCard();
            $card->setName($name);
            $card->setTheme($theme);
            $card->setImagePath('');
            $em->persist($card);
            // premiere sauvegarde pour obtenir un ID afin de nommer le ficher
            $em->flush();
        }

        $fileInfos = $_FILES['memoryImage'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];

        $fileName = "memorycard_".sprintf("%d", microtime(true) * 1000000).".".$type;
        $card->setImagePath("img/memorycard/".$fileName);

        $filePath = "./img/memorycard/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);
        
        $em->flush();

        return $card;
    }

     /**
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteMemorycardsAction(MemoryCard $memoryCard){
        $em = $this->getDoctrine()->getManager();
        $em->remove($memoryCard);
        $em->flush();
    }
}

?>  