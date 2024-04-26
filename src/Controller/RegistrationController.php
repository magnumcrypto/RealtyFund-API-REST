<?php

namespace App\Controller;

use App\Repository\RegistredUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, RegistredUserRepository $registredUserRepo): JsonResponse
    {
        /* 
        $data = json_decode($request->getContent());

        $user = new RegistredUser();

        $hashedPassword = $passwordHasher->hashPassword($user, $data->password);
        $user->setPassword($hashedPassword); 
        */
        $data = json_decode($request->getContent());
        $user = $registredUserRepo->registerUser($data, $passwordHasher);
        if (!$user) {
            return new JsonResponse(['error' => 'Datos invalidos', 'status' => 400], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse(['message' => 'Usuario registrado correctamente', 'status' => 201], Response::HTTP_CREATED);
    }
}
