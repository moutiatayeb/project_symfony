<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/condidat", name="condidat_")
 */
class CondidatController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('condidat/index.html.twig');
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('condidat/test.html.twig');
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function compte(): Response
    {
        return $this->render('condidat/compte.html.twig');
    }

    /**
     * @Route("/historique", name="historique")
     */
    public function historique()
    {
        return $this->render('condidat/historique.html.twig');
    }

    /**
     * @Route("/listecours", name="listecours", methods={"GET"})
     */
    public function listeCours(CoursRepository $coursRepository): Response
    {
        return $this->render('condidat/listecours.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail", methods={"GET"})
     */
    public function detailCours(Cours $cour): Response
    {
        return $this->render('condidat/detail-cours.html.twig', [
            'cour' => $cour,
        ]);
    }
}
