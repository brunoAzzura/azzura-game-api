<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use App\Entity\Avatar;
use Symfony\Component\Filesystem\Filesystem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class AvatarsController extends AbstractController{
    use ControllerTrait;
    /**
     * @View()
     */
    public function getAvatarsAction(){
        $em = $this->getDoctrine()->getManager();
        $avatars = $this->getDoctrine()
        ->getRepository(Avatar::class)
        ->findAll();

        return $avatars;
    }

    /**
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function postAvatarsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $fileSystem = new Filesystem();
        if(!$fileSystem->exists('./img/avatar')){
            $fileSystem->mkdir('./img/avatar');
        }

        $libelle = $_REQUEST['libelle'];

        $avatarId = null;
        if(isset($_REQUEST['avatar_id'])) {
            $avatarId = $_REQUEST['avatar_id'];
            $avatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($avatarId);

            $avatar->setLibelle($libelle);
            // supprssion de l'ancien fichier s'il existe 
            if($fileSystem->exists('./'.$avatar->getImagePath())) {
                $fileSystem->remove('./'.$avatar->getImagePath());
            }
        }
        else{
            $avatar = new Avatar();
            $avatar->setLibelle($libelle);
            $avatar->setImagePath('');
            $em->persist($avatar);
            // premiere sauvegarde pour obtenir un ID afin de nommer le ficher
            $em->flush();
        }

        $fileInfos = $_FILES['image'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];

        $fileName = "avatar_".sprintf("%d", microtime(true) * 1000000).".".$type;
        $avatar->setImagePath("img/avatar/".$fileName);

        $filePath = "./img/avatar/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);
        
        $em->flush();

        return $avatar;
    }

    /**
     * @Rest\Put("/avatars")
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("avatar", converter="fos_rest.request_body")
     */
    public function putAvatarsAction(Avatar $avatar){
        //updates a single resource for this type
        $em = $this->getDoctrine()->getManager();
        $em->merge($avatar);

        $em->flush();
        return $avatar;
    }
}

?>  