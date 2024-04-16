<?php

namespace App\Controller;

use App\Repository\InvestmentsRepository;
use App\Repository\RentPropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentsPropertyController extends AbstractController
{
    #[Route('/rents', name: 'app_get_rents', methods: ['GET'])]
    public function getAll(RentPropertyRepository $rentPropertyRepository, InvestmentsRepository $investmentsRepository): JsonResponse
    {
        $rentsProperty = $rentPropertyRepository->findAllJSON($investmentsRepository);

        if (is_null($rentsProperty)) {
            return new JsonResponse(['message' => 'No hay propiedades en alquiler'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($rentsProperty, Response::HTTP_OK);
    }

    #[Route('/rents', name: 'app_get_orderly_rents', methods: ['POST'])]
    public function getOrderlyProperties(Request $request, RentPropertyRepository $rentPropertyRepository, InvestmentsRepository $investmentsRepository): JsonResponse
    {
        $filtersData = json_decode($request->getContent());
        if (!isset($filtersData)) {
            return new JsonResponse(['message' => 'No se han enviado filtros'], Response::HTTP_BAD_REQUEST);
        }
        $orderlyRents = $rentPropertyRepository->findOrderlyPropertiesJSON($filtersData, $investmentsRepository);
        if (is_null($orderlyRents)) {
            return new JsonResponse(['message' => 'No hay propiedades en alquiler'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($orderlyRents, Response::HTTP_OK);
    }
}
