<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaceController extends AbstractController
{
    #[Route('/races', name: 'races_list')]
    public function getRaces(): Response
    {
				if (!$this->getUser()) {
					return $this->redirectToRoute('app_login');
				}
				$races = $this->getUser()?->getCompany()?->getRaces();
        return $this->json(array_map(
					static fn($race) => ['id' => $race->getId(), 'name' => $race->getName()],
					$races->getValues()
        ), context: ['race_list']);
    }
}
