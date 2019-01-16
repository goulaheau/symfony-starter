<?php

namespace App\Security;

use App\Entity\User\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler as BaseHandler;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessHandler extends BaseHandler
{
    /**
     * @param UserInterface|User $user
     * @param null               $jwt
     * @return JWTAuthenticationSuccessResponse
     */
    public function handleAuthenticationSuccess(UserInterface $user, $jwt = null)
    {
        if (null === $jwt) {
            $jwt = $this->jwtManager->create($user);
        }

        $response = new JWTAuthenticationSuccessResponse($jwt);
        $event    = new AuthenticationSuccessEvent([
            'token' => $jwt,
            'user'  => [
                'id'       => $user->getId(),
                'username' => $user->getUsername(),
                'roles'    => $user->getRoles(),
            ],
        ], $user, $response);

        $this->dispatcher->dispatch(Events::AUTHENTICATION_SUCCESS, $event);
        $response->setData($event->getData());

        return $response;
    }
}
