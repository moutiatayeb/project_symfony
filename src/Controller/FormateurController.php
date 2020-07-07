<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Question;
use App\Form\CoursType;
use App\Form\QuestionType;
use App\Repository\CoursRepository;
use App\Repository\QuestionRepository;
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

            return $this->redirectToRoute('formateur_listecours');
        }

        return $this->render('formateur/cree.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affichage", methods={"GET"})
     */
    public function affichageCours(Cours $cour): Response
    {
        return $this->render('formateur/affichage.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/{id}/modification", name="modification", methods={"GET","POST"})
     */
    public function modificationCours(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formateur_listecours');
        }

        return $this->render('formateur/modification.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supprimer", methods={"DELETE"})
     */
    public function supprimCours(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formateur_index');
    }

    /**
     * @Route("/questions/liste", name="listequestions", methods={"GET"})
     */
    public function listeQuestions(QuestionRepository $questionRepository): Response
    {
        return $this->render('formateur/questions.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/question/ajout", name="ajoutquestion", methods={"GET","POST"})
     */
    public function ajoutQuestion(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('formateur_listequestions');
        }

        return $this->render('formateur/cree-question.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("questions/{id}", name="affichagequestion", methods={"GET"})
     */
    public function show(Question $question): Response
    {
        return $this->render('formateur/affichage-question.html.twig', [
            'question' => $question,
        ]);
    }

    /**
     * @Route("question/{id}/modification", name="modificationquestion", methods={"GET","POST"})
     */
    public function modificationQuestion(Request $request, Question $question): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formateur_listequestions');
        }

        return $this->render('formateur/modification-question.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("question/{id}", name="effacerquestion", methods={"DELETE"})
     */
    public function effacerQuestion(Request $request, Question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formateur_listequestions');
    }

    /**
     * @Route("cours/{id}", name="effacercours", methods={"DELETE"})
     */
    public function delete(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formateur_listecours');
    }
}
