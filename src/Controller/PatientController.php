<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\User;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/patient')]
class PatientController extends AbstractController
{
    #[Route('/dashboard', name: 'patient_dashboard')]
    public function index(PatientRepository $patientRepository): Response
    {
				if (!$this->getUser()) {
					return $this->redirectToRoute('app_login');
				}
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
						'user' => $this->getUser(),
	          'patients' => json_encode(array_map(
							static fn($item) => [
								'id' => $item->getId(),
								'firstname' => $item->getFirstname(),
								'lastname' => $item->getLastname(),
								'balance' => $item->getBalance(),
							],
							$this->getUser()?->getPatients()->getValues()
	          ), JSON_THROW_ON_ERROR),
	          'current_balance' => $patientRepository->findCurrentCompanyBalance($this->getUser()->getId()),
        ]);
    }
		
		#[Route(path: '/add', methods: 'POST', name: 'add_patient')]
		public function addPatient(EntityManagerInterface $entityManager)
		{
			$admin = $entityManager->getRepository(User::class)->find(5);
			$patient = new Patient();
			$patient->setFirstname($_POST['firstname'])
				->setLastname($_POST['lastname'])
				->setBalance(0)
				->addUser($this->getUser())
				->addUser($admin);
			$entityManager->persist($patient);
			$entityManager->flush();
			return $this->json(['id' => $patient->getId(), 'firstname' => $patient->getFirstname(), 'lastname' => $patient->getLastname(), 'balance' => $patient->getBalance()]);
		}
}
