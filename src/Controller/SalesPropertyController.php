<?php

namespace App\Controller;

use App\Repository\InvestmentsRepository;
use App\Repository\SalePropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalesPropertyController extends AbstractController
{
    #[Route('/sales', name: 'app_get_sales', methods: ['GET'])]
    public function getAll(SalePropertyRepository $salePropertyRepo, InvestmentsRepository $investmentsRepository): JsonResponse
    {
        $salesProperty = $salePropertyRepo->findAllJSON($investmentsRepository);
        if (is_null($salesProperty)) {
            return new JsonResponse(['message' => 'No hay propiedades en venta'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($salesProperty, Response::HTTP_OK);
    }

    #[Route('/sales', name: 'app_get_orderly_sales', methods: ['POST'])]
    public function getOrderlyProperties(Request $request, SalePropertyRepository $salePropertyRepo, InvestmentsRepository $investmentsRepository): JsonResponse
    {
        $filtersData = json_decode($request->getContent());
        if (!isset($filtersData)) {
            return new JsonResponse(['message' => 'No se han enviado filtros'], Response::HTTP_BAD_REQUEST);
        }
        $orderlySales = $salePropertyRepo->findOrderlyPropertiesJSON($filtersData, $investmentsRepository);
        if (is_null($orderlySales)) {
            return new JsonResponse(['message' => 'No hay propiedades en venta'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($orderlySales, Response::HTTP_OK);
    }
}
