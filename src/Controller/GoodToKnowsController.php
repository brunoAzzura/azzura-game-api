<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\GoodToKnow;
use App\Entity\Theme;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class GoodToKnowsController extends AbstractController{
    use ControllerTrait;
    /**
     * @View(serializerGroups={"get-goodtoknows"})
     */
    public function getGoodtoknowsAction(){
        $em = $this->getDoctrine()->getManager();
        $goodtoknows = $this->getDoctrine()
        ->getRepository(GoodToKnow::class)
        ->findAll();

        return $goodtoknows;
    }

    /**
     * @View(serializerGroups={"get-goodtoknows"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function postGoodtoknowsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $fileSystem = new Filesystem();
        if(!$fileSystem->exists('./img/goodtoknow')){
            $fileSystem->mkdir('./img/goodtoknow');
        }

        $wording = $_REQUEST['wording'];
        $info = $_REQUEST['info'];
        
        $world = null;

        if(isset($_REQUEST['themeId'])){
            $themeId = $_REQUEST['themeId'];
            $theme = $this->getDoctrine()
            ->getRepository(Theme::class)
            ->find($themeId);
        }
        

        $goodtoknowId = null;
        if(isset($_REQUEST['goodtoknow_id'])) {
            $goodtoknowId = $_REQUEST['goodtoknow_id'];
            $goodtoknow = $this->getDoctrine()
            ->getRepository(GoodToKnow::class)
            ->find($goodtoknowId);
            $goodtoknow->setWording($wording);
            $goodtoknow->setInfo($info);
            $goodtoknow->setTheme($theme);

            // supprssion de l'ancien fichier s'il existe 
            if($fileSystem->exists('./'.$goodtoknow->getPath())) {
                $fileSystem->remove('./'.$goodtoknow->getPath());
            }
        }
        else{
            $goodtoknow = new Goodtoknow();
            $goodtoknow->setWording($wording);
            $goodtoknow->setTheme($theme);
            $goodtoknow->setPath('');
            $goodtoknow->setInfo($info);
            $goodtoknow->setType('img');
            $em->persist($goodtoknow);
            // premiere sauvegarde pour obtenir un ID afin de nommer le ficher
            $em->flush();
        }

        $fileInfos = $_FILES['image'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];

        $fileName = "goodtoknow_".sprintf("%d", microtime(true) * 1000000).".".$type;
        $goodtoknow->setPath("img/goodtoknow/".$fileName);

        $filePath = "./img/goodtoknow/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);
        
        $em->flush();

        return $goodtoknow;
    }

    /**
     * @Rest\Put("/goodtoknows")
     * @View(serializerGroups={"get-goodtoknows"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("goodtoknow", converter="fos_rest.request_body")
     */
    public function putGoodtoknowsAction(GoodToKnow $goodtoknow){
        //updates a single resource for this type
        $em = $this->getDoctrine()->getManager();
        $em->merge($goodtoknow);

        $em->flush();
        return $goodtoknow;
    }
}

?>  