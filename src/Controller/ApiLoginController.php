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
    #[Route('/login', name: 'login', methods: ['POST'])] // Añadir metodo POST si es necesario
    public function login(#[CurrentUser] ?RegistredUser $user): JsonResponse
    {
        /* 
            {
                "username": "dunglas@example.com",
                "password": "MyPassword"
            }
        */
        if (null === $user) {
            return new JsonResponse(['message' => 'Credenciales invalidas', 'status' => 401], Response::HTTP_UNAUTHORIZED);
        }

        $token = 'Hay que crear un token pero no se como';

        return new JsonResponse(
            [
                'message' => $user->getUserIdentifier(),
                'role' => $user->getRoles(),
                'token' => $token,
                'status' => 200
            ],
            Response::HTTP_OK
        );
    }
}
