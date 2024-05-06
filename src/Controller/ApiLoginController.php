<?php

namespace App\Controller;

use App\Entity\RegistredUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                'email' => $user->getEmail(),
                'token' => $token,
                'status' => 200
            ],
            Response::HTTP_OK
        );
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout(): JsonResponse
    {
        return new JsonResponse(['message' => 'Sesión cerrada', 'status' => 200], Response::HTTP_OK);
    }
}
