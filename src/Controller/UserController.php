<?php

namespace App\Controller;

use App\Entity\BillingPeriod;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user')]
class UserController extends AbstractController
{
	#[Route('/dashboard', name: 'user_dashboard')]
    public function index(UserRepository $userRepository): Response
    {
				if (!$this->getUser()) {
					return $this->redirectToRoute('app_login');
				}
				$users = $userRepository->findBy(['active' => true]);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
						'user' => $this->getUser(),
	          'users' => json_encode(array_map(
							static function($item) {
								$billingPeriod = $item->getBillingPeriods()->last();
								if ($billingPeriod && $billingPeriod->getEnd() !== null) {
									$billingPeriod = null;
								}
								return 	[
									'id' => $item->getId(),
									'email' => $item->getEmail(),
									'firstname' => $item->getFirstname(),
									'roles' => $item->getRoles(),
									'area' => $item->getArea(),
									'billingPeriod' => $billingPeriod ?
										[ 'id' => $billingPeriod->getId(),
											'startDate' => $billingPeriod->getStart()?->format('d/m/Y'),
											'balance' => $billingPeriod->getBalance(),
											'numberOfPayments' => $billingPeriod->getNumberOfAppointments(),
											'user' => ['id' => $item->getId()]]
										: ['id' => null, 'userId' => $item->getId()],
								];
              },
		          $users
	          ), JSON_THROW_ON_ERROR)
        ]);
    }
		
		#[Route(path: '/addUser', name: 'user_add', methods: 'POST')]
		public function addUser(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
		{
			$user = new User();
			$user->setEmail($_POST['email'])
				->setFirstname($_POST['firstname'])
				->setRoles($_POST['roles'])
				->setArea($_POST['area'])
				->setPassword($passwordHasher->hashPassword($user, $_POST['password']))
				->setActive(true);
			$entityManager->persist($user);
			$entityManager->flush();
			return $this->json($user);
		}
		
		#[Route(path: '/startNewBillingPeriod', name: 'billing_period_start', methods: 'POST')]
		public function startNewBillingPeriod(EntityManagerInterface $entityManager)
		{
			$user = $entityManager->getRepository(User::class)->find($_POST['userId']);
			$oneAlreadyExists = isset($_POST['id']);
			$shouldCreateNewBillingPeriod = filter_var($_POST['shouldCreateNewBillingPeriod'], FILTER_VALIDATE_BOOLEAN);
			
			if ($oneAlreadyExists) {
				//Fin de l'existante
				$oldBillingPeriod = $entityManager->getRepository(BillingPeriod::class)->find($_POST['id']);
				$oldBillingPeriod->setEnd(new DateTime());
				$entityManager->persist($oldBillingPeriod);
			}
			
			$newBillingPeriod = null;
			if ($shouldCreateNewBillingPeriod) {
				$newBillingPeriod = new BillingPeriod();
				$newBillingPeriod->setUser($user);
				$entityManager->persist($newBillingPeriod);
			}
			$entityManager->flush();
			
			return $this->json(
				data: [
					'id' => $newBillingPeriod?->getId(),
					'startDate' => $newBillingPeriod?->getStart()?->format('d/m/Y'),
					'balance' => $newBillingPeriod?->getBalance(),
					'numberOfPayments' => $newBillingPeriod?->getNumberOfAppointments(),
					'user' => [
						'id' => $_POST['userId'],
					]
				],
				context: ['groups' => 'billingPeriod']
			);
		}
		
		#[Route(path: '/wtf')]
		public function wtf() {
			$result = [];
			
			function getAlphabet($number) {
				if ($number>26 || $number < 1) {
					return "pas autant de lettres dans l'alphabet";
				}
				$alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
				return $alphabet[$number+1];
			}
			
			
			// Ecrire une fonction qui prend en paramètre une lettre et renvoie sa place dans l'alphabet
			// alphabet('a') doit renvoyer 1 car la place de la lettre a dans l'alphabet est la première
			function alphabet($letter) {
				$alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
				return array_search($letter, $alphabet, true)+1;
			}
			
			// Créer une fonction qui prend en paramètre l'âge d'un individu et lui dit s'il est majeur ou non
			// Si l'individu à 32ans, dites lui que vous l'aimez
			function amIAdult() {
			
			}
			
			
			$result = [
				'Devrait être false' => amIAdult(17),
				'Devrait être true' => amIAdult(18),
				'Devrait être true aussi' => amIAdult(19),
				'Devrait être ma femme' => amIAdult(32),
			];
			
			return $this->json($result);
		}
}
