<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {

        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
        ]);
    }

    #[Route('/program/{id}', methods : ['GET'],name: 'program_')]
    public function show(ProgramRepository $programRepository, int $id): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'id' => $id,
        ]);
    }
}
