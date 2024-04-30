<?php

namespace App\Controller;

use App\Entity\RegistredUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;
    private JWTTokenManagerInterface $JWTManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, JWTTokenManagerInterface $JWTManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->JWTManager = $JWTManager;
    }

    #[Route('/login', name: 'login', methods: ['POST'])] // Añadir metodo POST si es necesario
    public function login(#[CurrentUser] ?RegistredUser $user, Request $request): JsonResponse
    {
        /* 
            {
                "username": "dunglas@example.com",
                "password": "MyPassword"
            }
        */
        $dataUser = json_decode($request->getContent());
        if (null === $user) {
            return new JsonResponse(['message' => 'Credenciales invalidas', 'status' => 401], Response::HTTP_UNAUTHORIZED);
        }
        if (!$this->passwordHasher->isPasswordValid($user, $dataUser->password)) {
            return new JsonResponse(['message' => 'Credenciales invalidas', 'status' => 401], Response::HTTP_UNAUTHORIZED);
        }
        $token = $this->JWTManager->create($user);

        return new JsonResponse(
            [
                'nickname' => $user->getNickname(),
                'token' => $token,
                'status' => 200
            ],
            Response::HTTP_OK
        );
    }

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(Security $security): JsonResponse
    {
        $token = $security->getToken();
        if (is_null($token)) {
            return new JsonResponse(['message' => 'User is not logged', 'status' => 401], Response::HTTP_UNAUTHORIZED);
        }
        $response = $security->logout(false);
        return new JsonResponse(['message' => $response, 'status' => 200], Response::HTTP_OK);
    }
}
