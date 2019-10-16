<?php
namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Answer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class AnswersController extends AbstractController{
    use ControllerTrait;
    /**
     * @Rest\Post("/answers")
     * @View(serializerGroups={"get-answer"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("answer", converter="fos_rest.request_body")
     */
    public function postAnswersAction(Answer $answer){
        $em = $this->getDoctrine()->getManager();
        
        // merge allow to link question and answer (with id) without modifying the question!
        $object = $em->merge($answer);
        $em->flush();

        return $object;
        
        // we could also create a postQuestionAnswersAction in QuestionController
    }

    /**
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteAnswersAction($id){
        $em = $this->getDoctrine()->getManager();
        $answer = $this->getDoctrine()
            ->getRepository(Answer::class)
            ->find($id);

        $em->remove($answer);
        $em->flush();

        return ["id" => $id];
    }
}