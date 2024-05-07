<?php

namespace App\Controller;

use App\Entity\RegistredUser;
use App\Repository\InvestmentsRepository;
use App\Repository\RegistredUserRepository;
use App\Repository\SalePropertyRepository;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersController extends AbstractController
{
    private JWTTokenManagerInterface $jwtManager;
    private TokenStorageInterface $tokenStorageInterface;

    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
    }

    #[Route('/users', name: 'app_users_insert', methods: ['POST'])]
    public function insert(Request $request, UserRepository $userRepository, InvestmentsRepository $invRepository, SalePropertyRepository $salePropertyRepository)
    {
        //dataUser is a object recieved from form in route /contact 
        $dataUser = json_decode($request->getContent());

        $user = $userRepository->insertUser($dataUser);
        if (is_null($user)) {
            return new JsonResponse(['status' => 'No ha sido posible la inserción del usuario'], Response::HTTP_UNAUTHORIZED);
        }
        $idSalesProperty = intval($dataUser->property);
        $saleProperty = $salePropertyRepository->findOneBy(['id' => $idSalesProperty]);
        if (is_null($saleProperty)) {
            return new JsonResponse(['status' => 'Datos incorrectos'], Response::HTTP_BAD_REQUEST);
        }
        $investment = $invRepository->insertInvestment($user, $saleProperty);
        if (is_null($investment)) {
            return new JsonResponse(['status' => 'No ha sido posible la inserción de la inversión'], Response::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse(
            [
                'message' => 'Se ha insertado la inversión y el inversor correctamente'
            ],
            Response::HTTP_ACCEPTED
        );
    }

    #[Route('/delete', name: 'app_users_delete', methods: ['DELETE'])]
    public function delete(Request $request, RegistredUserRepository $userRepo)
    {
        /* $token = $this->tokenStorageInterface->getToken();
        //dump($token);
        if (!$token) {
            return new JsonResponse(['status' => 'No se ha podido obtener el token'], Response::HTTP_UNAUTHORIZED);
        }
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return new JsonResponse(['status' => 'No se ha podido obtener el usuario'], Response::HTTP_UNAUTHORIZED);
        }
        //dump($user); */
        $dataUser = json_decode($request->getContent());
        $deleted = $userRepo->deleteUser($dataUser);
        if (!$deleted) {
            return new JsonResponse(['status' => 'No se ha podido eliminar el usuario'], Response::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse([
            'msg' => 'Usuario eliminado',
            'status' => 200
        ], Response::HTTP_OK);
    }
}
