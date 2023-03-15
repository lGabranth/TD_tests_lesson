<?php

namespace App\Controller;

use App\Repository\InterventionRepository;
use App\Repository\PatientRepository;
use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(
			InterventionRepository $interventionRepository,
			PaymentRepository $paymentRepository,
	    PatientRepository $patientRepository
    ): Response
    {
			if (!$this->getUser()) {
				return $this->redirectToRoute('app_login');
			}
			$interventions = $interventionRepository->findBy(['active' => true]);
			$lastPayments = array_map(static fn($item) => [
					'id' => $item->getId(),
					'amount' => $item->getAmount(),
					'patient' => [
						'id' => $item->getPatient()->getId(),
						'firstname' => $item->getPatient()->getFirstname(),
						'lastname' => $item->getPatient()->getLastname(),
					],
					'intervention' => [
						'id' => $item->getIntervention()->getId(),
						'amount' => $item->getIntervention()->getAmount(),
						'name' => $item->getIntervention()->getName(),
					],
					'paymentMethod' => $item->getPaymentMethod(),
					'difference' => $item->getAmount() - $item->getIntervention()->getAmount(),
					'date' => $item->getCreatedAt()->format('d/m/Y'),
				], $paymentRepository->findBy(['user' => $this->getUser()->getId()], ['createdAt' => 'DESC'], 10) ?? []
			);
			$patients = array_map(static fn($item) => [
				'id' => $item->getId(),
				'firstname' => $item->getFirstname(),
				'lastname' => $item->getLastname(),
				'balance' => $item->getBalance(),
			], $this->getUser()?->getPatients()->getValues() ?? []);
			$patientsNotGood = $patientRepository->getPatientsNotGood($this->getUser()->getId());
			$amount = 0;
			foreach ($patientsNotGood as $patient) {
				$amount += $patient['balance'];
			}
			return $this->render('dashboard/index.html.twig', [
				'controller_name' => 'DashboardController',
				'user' => $this->getUser(),
				'interventions' => json_encode(array_map(static fn($item) => [
					'id' => $item->getId(), 'name' => $item->getName(), 'amount' => $item->getAmount()
				], $interventions), JSON_THROW_ON_ERROR),
				'last_payments' => json_encode($lastPayments, JSON_THROW_ON_ERROR),
				'patients_not_good' => json_encode($patientsNotGood, JSON_THROW_ON_ERROR),
				'patients' => json_encode($patients, JSON_THROW_ON_ERROR),
				'amount' => $amount,
			]);
    }
}
