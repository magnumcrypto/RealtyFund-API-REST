<?php

namespace App\Controller;

use App\Entity\RegistredUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'login')] // Añadir metodo POST si es necesario
    public function login(#[CurrentUser] ?RegistredUser $user): JsonResponse
    {
        /* 
            {
                "username": "dunglas@example.com",
                "password": "MyPassword"
            }
        */
        if (null === $user) {
            return new JsonResponse(['message' => 'Credenciales invalidas'], Response::HTTP_UNAUTHORIZED);
        }

        $token = 'Hay que crear un token pero no se como';

        return new JsonResponse(
            [
                'message' => $user->getUserIdentifier(),
                'token' => $token,
            ],
            Response::HTTP_OK
        );
    }
}
