<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Exception\ValidationException;
use App\EntityMerger\EntityMerger;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Service\FileUploader;

/**
 * @Security("is_authenticated()")
 */
class QuestionsController extends AbstractController{

    use ControllerTrait;


    /**
     * @var EntityMerger
     */
    private $entityMerger;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct(
        EntityMerger $entityMerger,
        ParameterBagInterface $params,
        FileUploader $fileUploader
    ) {
        $this->entityMerger = $entityMerger;
        $this->params = $params;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteQuestionsAction(Question $question){
        $em = $this->getDoctrine()->getManager();
        // delete also answers in cascade 
        $em->remove($question);
        $em->flush();
    }

    /**
     * @View()
     */
    public function getQuestionAnswersAction(Question $question) 
    {
        return $question->getAnswers();
    }

    /**
     * @View(serializerGroups={"get-answer"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("answer", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postQuestionAnswersAction(Question $question, Answer $answer, ConstraintViolationListInterface $validationErrors) 
    {

        if(count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $answer->setQuestion($question);
        $em = $this->getDoctrine()->getManager();
        $em->persist($answer);
        
        # Work without adding the answer to the question
        $question->getAnswers()->add($answer);
        $em->persist($question);

        $em->flush();

        return $answer;

    }

    //, options={"validator"= {"groups" = {"Patch"}}}
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
     * @Rest\NoRoute()
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function postImageQuestionUploadAction(?question $question, Request $request) 
    {
        $file = $request->files->get('questionImage');
        $filePath = $this->fileUploader->uploadFile($file, 'question');

        $question->setImagePath($filePath);
        $this->persistQuestion($question);
        
        return $question;
    }

    public function persistQuestion($question){
        $em = $this->getDoctrine()
        ->getManager();
        $em->persist($question);
        $em->flush();
    }
}