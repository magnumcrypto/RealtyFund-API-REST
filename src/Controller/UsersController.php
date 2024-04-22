<?php

namespace App\Controller;

use App\Repository\InvestmentsRepository;
use App\Repository\SalePropertyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
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
}
