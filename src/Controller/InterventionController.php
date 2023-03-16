<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/intervention')]
class InterventionController extends AbstractController
{
    #[Route('/', name: 'intervention_dashboard')]
    public function index(InterventionRepository $interventionRepository): Response
    {
				if (!$this->getUser()) {
					return $this->redirectToRoute('app_login)');
				}
				$interventions = $interventionRepository->findBy(['active' => true]);
        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'InterventionController',
            'interventions' => json_encode(array_map(
							static fn($item) => [
								'id' => $item->getId(),
								'name' => $item->getName(),
								'amount' => $item->getAmount(),
							],
							$interventions
            ), JSON_THROW_ON_ERROR),
	          'user' => $this->getUser()
        ]);
    }
		
		#[Route(path: '/add', methods: 'POST', name: 'intervention_add')]
		public function add(EntityManagerInterface $entityManager): Response
		{
			$intervention = new Intervention();
			$intervention->setName($_POST['intitulate'])
				->setAmount($_POST['amount'])
				->setActive(true);
			$entityManager->persist($intervention);
			$entityManager->flush();
			return $this->json(['id' => $intervention->getId(), 'name' => $intervention->getName(), 'amount' => $intervention->getAmount()]);
		}
}
