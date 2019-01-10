<?php

namespace App\Security;

use App\Entity\User\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    protected $auth = false;

    /**
     * @var ObjectManager
     */
    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        if ($request->getRequestUri() === '/auth') {
            $this->auth = true;

            return true;
        }

        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        if ($this->auth) {
            return [
                'email'    => $request->query->get('email'),
                'password' => $request->query->get('password'),
            ];
        }

        return [
            'token' => $request->headers->get('X-AUTH-TOKEN'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if ($this->auth) {
            return $this->manager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);
        }

        $apiToken = $credentials['token'];

        if (null === $apiToken) {
            return;
        }

        return $this->manager->getRepository(User::class)->findOneBy(['apiToken' => $apiToken]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($this->auth) {

        }

        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData()),

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required',
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
