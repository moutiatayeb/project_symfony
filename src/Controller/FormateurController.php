<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formateur", name="formateur_")
 */
class FormateurController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('formateur/index.html.twig');
    }

    /**
     * @Route("/cours", name="cours")
     */
    public function cours()
    {
        return $this->render('formateur/cours.html.twig');
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function compte()
    {
        return $this->render('formateur/compte.html.twig');
    }

    /**
     * @Route("/historique", name="historique")
     */
    public function historique()
    {
        return $this->render('formateur/historique.html.twig');
    }

    /**
     * @Route("/listecours", name="listecours", methods={"GET"})
     */
    public function listeCours(CoursRepository $coursRepository): Response
    {
        return $this->render('formateur/cours.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajout", name="ajout", methods={"GET","POST"})
     */
    public function ajoutCours(Request $request): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('formateur/cree.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }
}
