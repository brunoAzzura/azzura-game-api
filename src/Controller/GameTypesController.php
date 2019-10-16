<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations\View;
use App\Entity\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class GameTypesController extends AbstractController{
    use ControllerTrait;
    /**
     * @View()
     */
    public function getGametypesAction(){
        $em = $this->getDoctrine()->getManager();
        $gameTypes = $this->getDoctrine()
        ->getRepository(GameType::class)
        ->findAll();

        return $gameTypes;
    }
}

?>  