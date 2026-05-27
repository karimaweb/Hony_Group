<?php

namespace App\Controller;

use App\Repository\CoursLangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
   
    public function index(
        CoursLangueRepository $coursLangueRepository
    ): Response {

        return $this->render('formation/index.html.twig', [

            'formations' => $coursLangueRepository->findAll(),

        ]);
    }
}