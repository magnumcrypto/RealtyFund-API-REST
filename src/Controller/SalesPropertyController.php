<?php

namespace App\Controller;

use App\Repository\InvestmentsRepository;
use App\Repository\SalePropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
