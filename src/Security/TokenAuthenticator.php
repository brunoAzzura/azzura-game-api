<?php 

namespace App\Security;

use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserProviderInterface;
// use Symfony\Component\Security\Core\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;

class TokenAuthenticator extends AbstractGuardAuthenticator {

    /**
     * @var JWTEncoderInterface
     */
    private $jwtEncoder;

    public function __construct(JWTEncoderInterface $jwtEncoder )
    {
        $this->jwtEncoder = $jwtEncoder;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(null, Response::HTTP_UNAUTHORIZED);
    }

    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor('Bearer', 'Authorization');
        $token = $extractor->extract($request);

        if(!$token){
            return false;
        }

        return $token;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try{
            $data = $this->jwtEncoder->decode($credentials);

            if(false === $data) {
                return null;
            }

            return $userProvider->loadUserByUsername($data['username']);
        } catch (JWTDecodeFailureException $exception) {
            return null;
        }
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(null, Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization');
    }
}


?>