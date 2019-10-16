<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\EntityMerger\EntityMerger;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\GoodToKnow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\WorldScore;
use App\Entity\User;
use App\Entity\UserAvatar;
use App\Entity\Avatar;
use App\Entity\BonusInvestment;
use App\Entity\Certificate;
use App\Entity\Theme;
use App\Entity\World;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Service\FileEditor;

/**
 * @Security("is_authenticated()")
 */
class UsersController extends AbstractController{

    use ControllerTrait;


    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var EntityMerger
     */
    private $entityMerger;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FileEditor
     */
    private $fileEditor;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        EntityMerger $entityMerger,
        EventDispatcherInterface $eventDispatcher,
        FileEditor $fileEditor
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityMerger = $entityMerger;
        $this->eventDispatcher = $eventDispatcher;
        $this->fileEditor = $fileEditor;
    }

    /**
     * @View(serializerGroups={"get-users"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function getUsersAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        return $users;
    }

    /**
     * @View(serializerGroups={"get-users"})
     * @Security("is_granted('show', theUser)", message="Access denied")
     */
    public function getUserAction(?User $theUser){
        if( null === $theUser) {
            return $this->view(null, 404);
        }

        return $theUser;
    }


    /**
     * @View(serializerGroups = {"get-user-goodtoknows"})
     */
    public function getUsersGood_to_knowsAction($id){
        //recuperation de tous les goodToKnows d'un User de type Type
        // $type = $paramFetcher->get('type');
        
        $goodToKnows = $this->getDoctrine()
        ->getRepository(GoodToKnow::class)
        ->findByUser($id);

        return $goodToKnows;
    }

    /**
     * @Rest\NoRoute()
     * @View(serializerGroups = {"get-user-bonus"})
     */
    public function getUsersBonusInvestismentsAction(User $user){
        $bonus = $user->getBonusInvestments();
        return $bonus;
    }

    /**
     * @View(serializerGroups = {"get-user-bonus"})
     */
    public function getUsersRandBonusInvestmentAction(User $user) {
        $bonusSelected = null;

        $entityManager = $this->getDoctrine()->getManager();
        $bonus =  $this->getDoctrine()
        ->getRepository(BonusInvestment::class)
        ->getBonusToUnlock($user->getId());

        if(count($bonus) > 0) {
            $randKey = array_rand($bonus);
            $bonusSelected = $bonus[$randKey]; 

            $user->addBonusInvestment($bonusSelected);

            $em = $this->getDoctrine()
            ->getManager();
            $em->merge($user);

            $entityManager->flush();
        }

        return ['reward' => $bonusSelected];
    }

    /**
     * @View(serializerGroups = {"get-user-worldScore"})
     */
    public function getUsersWorldsScoresAction(User $user){
        $worldsScores = $user->getWorldScores();
        return $worldsScores;
    }

    /**
     * @View(serializerGroups = {"get-bonus"})
     */
    public function getUsersRand_good_to_knowAction(User $user, Theme $theme) {
       // @todo : garder une méthode get ? 

        $entityManager = $this->getDoctrine()->getManager();

        $goodToKnow = null;

        $goodToKnows = $this->getDoctrine()
        ->getRepository(GoodToKnow::class)
        ->getGoodToKnowToUnlock($user->getId(), $theme->getId());

        if(count($goodToKnows)>0) {
            $randKey = array_rand($goodToKnows);
            $goodToKnow = $goodToKnows[$randKey]; 
            
            $user->addGoodToKnow($goodToKnow);

            $worldScore = $entityManager->getRepository(WorldScore::class)
            ->findOneBy([
                'user' => $user,
                'world' => $theme->getWorld()
            ]);

            if($worldScore) {
                $worldScore->setScore($worldScore->getScore()+1);
            } else{
                $worldScore = new WorldScore();
                $worldScore->setCompleted(false);
                $worldScore->setScore(1);
                $worldScore->setUser($user);
                $worldScore->setWorld($theme->getWorld());
                $entityManager->persist($worldScore);
            }

            $entityManager->flush();
        }

        return ['reward' => $goodToKnow];
    }

    /**
     * @Rest\NoRoute()
     * @View(serializerGroups={"get-users"})
     */
    public function postUserCompleteWorldAction(User $user, World $world) {

        $em = $this->getDoctrine()->getManager();
        $worldScore = $em->getRepository(WorldScore::class)
                ->findOneBy([
                    'user' => $user,
                    'world' => $world,
                ]);

        if(!$worldScore->getCompleted()){
            $user->setRanking($user->getRanking() + 1);
            $em->merge($user);
            $worldScore->setCompleted(true);
            $em->flush();

            if($user->getRanking() === 5) {
                $this->createUserCertificate($user); // @todo : move this method
            }
        }

        return $user;
    } 

    // /**
    //  * @Rest\Post("/users/completes/worlds")
    //  * @View()
    //  * @ParamConverter("worldScore", converter="fos_rest.request_body")
    //  */
    // public function postUserCompleteWorldAction(WorldScore $worldScore) {

    //     $em = $this->getDoctrine()->getManager();
    //     $oldWorldScore = $em->getRepository(WorldScore::class)
    //             ->findOneBy([
    //                 'user' => $worldScore->getUser(),
    //                 'world' => $worldScore->getWorld(),
    //             ]);

    //     $user = null;

    //     // cas de la premiere succession du monde
    //     if($worldScore->getScore() >=  WorldScore::SCORE_SUCCESS_WORLD 
    //     && ($oldWorldScore == null || ($oldWorldScore->getScore() < WorldScore::SCORE_SUCCESS_WORLD))){
    //         // $user = $worldScore->getUser();
    //         // $em->merge($user);
    //         $user = $em->getRepository(User::class)
    //             ->find($worldScore->getUser()->getId());
    //         $user->setRanking($user->getRanking() + 1);
    //     }

    //     // Cas : 1 score a déja été enregistré pour le couple monde/utilisateur
    //     if($oldWorldScore !== null) {
    //         if($worldScore->getScore() > $oldWorldScore->getScore()) {
    //             $oldWorldScore->setScore($worldScore->getScore());
    //         }
    //         $em->flush();
    //     } 
    //     // Cas : aucun score n'a encore été enregistré 
    //     else {
    //         // enregistre bien world + user
    //         $em->merge($worldScore);
    //         $em->flush();
    //     }

    //     return $user;
    // } 

    /**
     * @Rest\Post("/user_edit_avatar")
     * @View()
     **/
    public function postUserEditAvatar(Request $request) {
        
        $userId = $request->request->get('userId');
        $avatarId = $request->request->get('avatarId');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
        ->find($userId);
        $avatar = $em->getRepository(Avatar::class)
        ->find($avatarId);

        foreach($user->getAvatar() as $userAvatar) {
            $em->remove($userAvatar);
        }
        $userAvatar = new UserAvatar();
        $userAvatar->setAvatar($avatar);
        $userAvatar->setUser($user);
        $userAvatar->setActif(true);
        $em->persist($userAvatar);
        $em->flush();

        //User n'est pas mi à jour (mais BDD ok)
        return $user;
    }

    // http://azzura.local/user_goodtoknow_stats/1

    /**
     * @View()
     **/
    public function getUser_goodtoknow_statsAction($userId) {
        //retourne pour chaque monde le nombre de bons à savoir + nb de bons a savoirs obtenus

        $goodToKnowsByWorld = $this->getDoctrine()
        ->getRepository(GoodToKnow::class)
        ->getNbGoodToKnowByWorld($userId);

        $goodToKnowsByWorldByUser = $this->getDoctrine()
        ->getRepository(GoodToKnow::class)
        ->getNbGoodToKnowByUserByWorld($userId);

        foreach($goodToKnowsByWorld as &$nbGoodToKnow ){
            $nbGoodToKnow['nbGoodToNowUnlock'] = 0;
            foreach($goodToKnowsByWorldByUser as $nbGoodToKnowByUser ){
                if($nbGoodToKnow['id'] == $nbGoodToKnowByUser['id']) {
                    $nbGoodToKnow['nbGoodToNowUnlock'] = $nbGoodToKnowByUser['nbGoodToKnowUnlock'];
                }
            }
        }

        return $goodToKnowsByWorld;
    }

    /**
     * @Rest\Get("/downloadcertificate/{user}", name="download_file")
     * @View()
     **/
    public function getDownloadCertificateAction(User $user){
        //@todo : check that the good user is connected

        $em = $this->getDoctrine()->getManager();
        $certificat = $em->getRepository(Certificate::class)
        ->findOneBy([
            'User' => $user
        ]);
        
        $response = new BinaryFileResponse('./' . $certificat->getPath());
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'certificate.pdf');

        return $response;
    }

    /**
     * @Rest\Get("/users_certificat/{user}", name="download_file")
     * @View()
     */
    public function getUserCertificateAction(User $user) {
        // @todo : dont load all the data (group)
        $em = $this->getDoctrine()->getManager();
        $certificat = $em->getRepository(Certificate::class)
        ->findOneBy([
            'User' => $user
        ]);
        return $certificat;
    }

    // ,
    //  *     options={"deserializationContext"={"groups"={"Deserialize"}}}
    // , ConstraintViolationListInterface $validationErrors
    /**
     * @Rest\View(statusCode=201)
     * @Rest\NoRoute()
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function postUserAction(User $user) {
        // if (count($validationErrors) > 0) {
        //     throw new ValidationException($validationErrors);
        // }

        $this->encodePassword($user);
        if($user->getRoles() === null || count($user->getRoles()) === 0) {
            $user->setRoles([User::ROLE_USER]);
        }
        $user->setRanking(0);
        $this->persistUser($user);


        $em = $this->getDoctrine()->getManager();
        $avatar = $em->getRepository(Avatar::class)->find(1);
        $userAvatar = new UserAvatar();
        $userAvatar->setAvatar($avatar);
        $userAvatar->setUser($user);
        $userAvatar->setActif(true);
        $em->persist($userAvatar);
        $em->flush();


        return $user;
    }

    //  * ,
    // ConstraintViolationListInterface $validationErrors
    // ,
    //  *     options={
    //  *         "validator"={"groups"={"Patch"}},
    //  *         "deserializationContext"={"groups"={"Deserialize"}}
    //  *     }
    /**
     * @Rest\NoRoute()
     * @Rest\View(statusCode=201)
     * @ParamConverter("modifiedUser", converter="fos_rest.request_body")
     * @Security("is_granted('edit', theUser)", message="Access denied")
     */
    public function patchUserAction(
        ?User $theUser, User $modifiedUser
    ) {
        if (null === $theUser) {
            throw new NotFoundHttpException();
        }

        // if (count($validationErrors) > 0) {
        //     throw new ValidationException($validationErrors);
        // }

        # Use custom merhe function
        if (empty($modifiedUser->getPassword())) {

            $modifiedUser->setPassword(null);
        }

        $this->entityMerger->merge(
            $theUser,
            $modifiedUser
        );

        if ($modifiedUser->getPassword() !== null) {
            $this->encodePassword($theUser);
        }
        $this->persistUser($theUser);

        // if ($modifiedUser->getPassword()) {
        //     $this->tokenStorage->invalidateToken($theUser->getUsername());
        // }
        return $theUser;
    }


    /**
     * @param User $user
     */
    protected function encodePassword(User $user): void
    {
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            )
        );
    }

    /**
     * @param User $user
     */
    protected function persistUser(User $user): void
    {
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($user);
        $em->flush();

        //On déclenche l'event
        // $event = new GenericEvent($user);
        // $this->eventDispatcher->dispatch('user.update', $event);
    }

    protected function createUserCertificate(User $user) {
        $path = $this->fileEditor->addTextToFile($user->getName());
        $certificate = new Certificate();
        $certificate->setUser($user);
        $certificate->setPath($path);

        $em = $this->getDoctrine()->getManager();
        $em->persist($certificate);
        $em->flush();
    }

     /**
     * @Rest\NoRoute()
     * @Rest\View(statusCode=201)
     * */
    public function resetGameAction($userId) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($userId);

        foreach($user->getWorldScores() as $worldScore ) {
            $em->remove($worldScore);
        }

        foreach($user->getCertificates() as $certificate ) {
            $em->remove($certificate);
        }

        $user->removeAllBonus();
        $user->setRanking(0);
   
        $em->persist($user);
        $em->flush();

        return ['delete' => true];
    }

}