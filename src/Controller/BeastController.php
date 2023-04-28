<?php
	
	namespace App\Controller;
	
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	class BeastController extends AbstractController {
		#[Route('/beast', name: 'beasts_dashboard')]
		public function index(): Response {
			if (!$this->getUser()) {
				return $this->redirectToRoute('app_login');
			}
			return $this->render('beast/index.html.twig', ['controller_name' => 'BeastController',]);
		}
		
		#[Route('/beasts', name: 'beasts_list')]
		public function getBeasts(): JsonResponse {
			return $this->json([['id' => 2, 'name' => 'Goblin'], ['id' => 3, 'name' => 'Orc'], ['id' => 4, 'name' => 'Troll'], ['id' => 5, 'name' => 'Giant'], ['id' => 6, 'name' => 'Dragon'], ['id' => 7, 'name' => 'Gryphon'], ['id' => 8, 'name' => 'Unicorn'], ['id' => 9, 'name' => 'Pegasus'], ['id' => 10, 'name' => 'Centaur'], ['id' => 11, 'name' => 'Minotaur'], ['id' => 12, 'name' => 'Cyclops'], ['id' => 13, 'name' => 'Hydra'], ['id' => 14, 'name' => 'Chimera'], ['id' => 15, 'name' => 'Cerberus'], ['id' => 16, 'name' => 'Phoenix'], ['id' => 17, 'name' => 'Basilisk'], ['id' => 18, 'name' => 'Manticore'], ['id' => 19, 'name' => 'Sphinx'], ['id' => 20, 'name' => 'Kraken'], ['id' => 21, 'name' => 'Leviathan'], ['id' => 22, 'name' => 'Behemoth'], ['id' => 23, 'name' => 'Satan'], ['id' => 24, 'name' => 'God'],]);
		}
	}
