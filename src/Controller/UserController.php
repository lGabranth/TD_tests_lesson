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
}
