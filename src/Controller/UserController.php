<?php

namespace App\Controller;

use App\Entity\BillingPeriod;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

	#[Route('/users/{id}', name: 'get_user')]
	public function getBeast(
		UserRepository $userRepository,
		int            $id
	): Response {
		if (!$this->getUser()) {
			return $this->redirectToRoute('app_login');
		}
		$user = $userRepository->find($id);
		return $this->json(data: $user);
	}
	
	#[Route('/users', name: 'get_users')]
	public function getUsers(UserRepository $userRepository): Response
	{
		if (!$this->getUser()) {
			return $this->redirectToRoute('app_login');
		}
		return $this->json($userRepository->findAll());
	}
	
	#[Route('register', name: 'register')]
	public function registration(
		EntityManagerInterface $manager,
		UserPasswordHasherInterface $passwordEncoder,
		Security $security
	)
	{
			if (empty($_POST)) {
				return $this->json(['error' => 'No data'], 400);
			}
			$_POST = json_decode(array_keys($_POST)[0], true);
      $user = new User();
			$user->setLogin($_POST['username']);
			$user->setFirstName($_POST['firstname']);
			$user->setLastName($_POST['lastname']);
			$user->setEmail($_POST['email']);
			$user->setRoles(['ROLE_USER']);
      $user->setPassword($passwordEncoder->hashPassword($user, $_POST['password']));
      $manager->persist($user);
      $manager->flush();
			
      $security->login($user);
			return $this->json(['success' => true]);
  }
}
