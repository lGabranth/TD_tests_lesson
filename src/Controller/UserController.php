<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
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
				$users = $userRepository->findBy(['active' => true]);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
						'user' => $this->getUser(),
	          'users' => json_encode(array_map(
							static fn($item) => [
								'id' => $item->getId(),
								'email' => $item->getEmail(),
								'firstname' => $item->getFirstname(),
								'roles' => $item->getRoles(),
								'area' => $item->getArea(),
							],
		          $users
	          ), JSON_THROW_ON_ERROR)
        ]);
    }
		
		#[Route(path: '/addUser', methods: 'POST')]
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
}
