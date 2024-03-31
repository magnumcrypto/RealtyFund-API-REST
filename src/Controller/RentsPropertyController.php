<?php

namespace App\Controller;

use App\Repository\RentPropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentsPropertyController extends AbstractController
{
    #[Route('/rents', name: 'app_get_rents', methods: ['GET'])]
    public function getAll(RentPropertyRepository $rentPropertyRepository): JsonResponse
    {
        $rentsProperty = $rentPropertyRepository->findAllJSON();

        if (is_null($rentsProperty)) {
            return new JsonResponse(['message' => 'No hay propiedades en alquiler'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($rentsProperty, Response::HTTP_OK);
    }
}
