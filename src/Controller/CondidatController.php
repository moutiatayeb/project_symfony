<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\CoursRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use App\service\ResultService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @Route("question/test/reponse", name="reponse", methods={"GET","POST"})
     */
    public function setReponse(Request $request,ResultService $resultService): Response
    {
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);
        
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($reponse);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('condidat_index');
//        }
//
        return $this->render('condidat/resultat.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
            'result'=>$resultService->CalculeResult(/*liste des reponses*/)]);
    }

    /**
     * @Route("/test/qestion", name="listequestions", methods={"GET"})
     */
    public function listeQuestions(QuestionRepository $questionRepository): Response
    {
        return $this->render('condidat/test.html.twig', [
            'questions' => $questionRepository->findAll()]);
    }
}
