<?php

namespace App\Controller\User;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/auth")
 */
class AuthController extends AbstractController
{
    /**
     * @param Request             $request
     * @param JWTEncoderInterface $JWTEncoder
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/validate", methods={"POST"})
     */
    public function validate(Request $request, JWTEncoderInterface $JWTEncoder)
    {
        $status = Response::HTTP_OK;
        $data = null;

        $token = $request->request->get('token', null);

        if (!$token) {
            return $this->json($data, Response::HTTP_BAD_REQUEST);
        }

        try {
            $data = $JWTEncoder->decode($token);
        } catch (\Exception $exception) {
            $status = Response::HTTP_UNAUTHORIZED;
        }

        return $this->json($data, $status);
    }
}
