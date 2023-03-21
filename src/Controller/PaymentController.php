<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\User;
use App\Repository\InterventionRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payment')]
class PaymentController extends AbstractController
{
		#[Route('/', name: 'payment_dashboard')]
    public function index(PatientRepository $patientRepository): Response
    {
				if (!$this->getUser()) {
					return $this->redirectToRoute('app_login');
				}
				$payments = array_map(static fn($item) => [
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
				], $this->getUser()?->getPayments()->getValues() ?? []);
				
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
	          'user' => $this->getUser(),
	          'payments' => json_encode($payments, JSON_THROW_ON_ERROR),
	          'current_balance' => $patientRepository->findCurrentCompanyBalance($this->getUser()->getId()),
        ]);
    }
		
		#[Route('/add', methods: 'POST', name: 'payment_add')]
		public function addPayment(
			InterventionRepository $interventionRepository,
			PatientRepository $patientRepository,
			EntityManagerInterface $entityManager
		): Response
		{
			$intervention = $interventionRepository->find($_POST['idIntervention']);
			$patient = $patientRepository->find($_POST['patient']['id']);
			$user = $this->getUser();
			$difference = $_POST['amount'] - $intervention->getAmount();
			$newBalance = $patient->getBalance() + $difference;
			
			$billingPeriod = $user?->getBillingPeriods()->last();
			$billingPeriod->setBalance($billingPeriod->getBalance() + $_POST['amount']);
			$billingPeriod->setNumberOfAppointments($billingPeriod->getNumberOfAppointments() + 1);
			$patient->setBalance($newBalance);
			
			$entityManager->persist($billingPeriod);
			$entityManager->persist($patient);
			
			$payment = new Payment();
			$payment->setAmount($_POST['amount']);
			$payment->setPaymentMethod($_POST['type']);
			$payment->setPatient($patient);
			$payment->setIntervention($intervention);
			$payment->setUser($this->getUser());
			$entityManager->persist($payment);
			$entityManager->flush();
			return $this->json([
					'id' => $payment->getId(),
					'amount' => $payment->getAmount(),
					'patient' => [
						'id' => $patient->getId(),
						'firstname' => $patient->getFirstname(),
						'lastname' => $patient->getLastname(),
					],
					'intervention' => [
						'id' => $intervention->getId(),
						'amount' => $intervention->getAmount(),
						'name' => $intervention->getName(),
					],
					'paymentMethod' => $payment->getPaymentMethod(),
					'difference' => $payment->getAmount() - $intervention->getAmount(),
					'date' => $payment->getCreatedAt()->format('d/m/Y'),
				]
			);
		}
}
