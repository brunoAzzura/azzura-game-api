<?php
namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use FOS\RestBundle\Controller\ControllerTrait;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Security("is_anonymous() or is_authenticated()")
 */
class TokensController extends AbstractController 
{
    use ControllerTrait;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var JWTEncoderInterface
     */
    private $jwtEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, JWTEncoderInterface $encoder) {
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtEncoder = $encoder;
    }

    /**
    * @Rest\View(statusCode=201)
     */
    public function postTokenAction (Request $request) {
  
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['username' => $username]);

        // @todo : à deplacer creation d'un password et sauvegarde en base
        // $passwordEncoder = $this->container->get('security.password_encoder');
        // $user->setPassword($passwordEncoder->encodePassword($user, 'testpass'));
        // $em->persist($user);
        // $em->flush();

        if(!$user) {
            throw new BadCredentialsException();
        }
        
        $isPasswordValid = $this->passwordEncoder->isPasswordValid($user, $password);

        if(!$isPasswordValid) {
            throw new BadCredentialsException();
        }

        $token = $this->jwtEncoder->encode([
            'username' => $username,
            'exp' => time() + 7200
        ]);

        // @todo : sauvegarder le token dans une table liée à l'utilisateur ?
        // @todo : retourner l'utilisateur connecté afin de le sauvegarder sur Angular!
        // @todo : sauvegarder les infos du profil ... img profil ...
            
        $data = array();
        $data['email'] = $user->getEmail();
        $data['roles'] = $user->getRoles();
        $data['username'] = $user->getUsername();
        $data['id'] = $user->getId();
        $data['ranking'] = $user->getRanking();

        return new JsonResponse(['token' => $token, 'user' => $data]);
    }
}

?>