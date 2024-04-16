<?php

namespace App\Controller;

use App\Repository\ExitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExitsController extends AbstractController
{
    #[Route('/exits', name: 'app_exits', methods: ['GET'])]
    public function index(ExitsRepository $exitsRepository): JsonResponse
    {
        $exits = $exitsRepository->findAllJSON();
        if (null === $exits) {
            return new JsonResponse(['message' => 'No exits found'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($exits, Response::HTTP_OK);
    }
}
