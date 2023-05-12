<?php
	
	namespace App\Controller;
	
	use App\Entity\Beast;
	use App\Repository\BeastRepository;
	use App\Repository\CompanyRepository;
	use App\Repository\RaceRepository;
	use DateTime;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
		
		#[Route('/beasts/{id}', name: 'get_beast')]
		public function getBeast(
			BeastRepository $beastRepository,
			int $id
		): Response {
			if (!$this->getUser()) {
				return $this->redirectToRoute('app_login');
			}
			$beast = $beastRepository->find($id);
			return $this->json(data: $beast, context: ['groups' => 'beast', 'datetime_format' => 'd/m/Y']);
		}
		
		#[Route('/beasts', name: 'beasts_list')]
		public function getBeasts(
			CompanyRepository $companyRepository
		): Response {
			if (!$this->getUser()) {
				return $this->redirectToRoute('app_login');
			}
			$beasts = $companyRepository->find($this->getUser()?->getCompany()?->getId())?->getBeasts();
			return $this->json(data: $beasts, context: ['groups' => 'beast', 'datetime_format' => 'd/m/Y']);
		}
		
		#[Route('/beasts/add', name: 'beasts_add', methods: 'POST')]
		public function addBeast(
			BeastRepository $beastRepository,
			RaceRepository $raceRepository
		): Response {
			if (!$this->getUser()) {
				return $this->redirectToRoute('app_login');
			}
			$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
			[
				'name' => $name,
				'race' => $race,
				'arrivalDate' => $arrivalDate,
				'arrivalReason' => $arrivalReason,
				'comments' => $comments
			] = $_POST;
			$beast = new Beast();
			$beast->setName($name);
			$beast->setRace($raceRepository->find($race));
			$beast->setArrivalDate(new DateTime($arrivalDate));
			$beast->setArrivalReason($arrivalReason);
			$beast->setIdentification($comments);
			$beast->setCompany($this->getUser()?->getCompany());
			$beastRepository->save($beast, true);
			return $this->json(['success' => true]);
		}
	}
