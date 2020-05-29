<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifierUtilisateurType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $user) {
        return $this->render("admin/utilisateurs.html.twig",[
            'users' => $user->findAll()
        ]);
    }

    /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function modifierUtilisateur(Request $request, User $user, EntityManagerInterface  $em) {

        $form = $this->createForm(ModifierUtilisateurType::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_utilisateurs');
        }

        return $this->render('admin/modifierUtilisateur.html.twig', ['formUser' => $form->createView()]);
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function compte(UserRepository $user) {
        return $this->render("admin/compte.html.twig");
    }

    /**
     * @Route("/historique", name="historique")
     */
    public function historique(UserRepository $user) {
        return $this->render("admin/historique.html.twig");
    }

//    /**
//     * @Route("/utilisateurs/effacer/{id}", name="effacer_utilisateur")
//     */
//    public function effacerUtilisateur(Request $request, User $user, EntityManagerInterface  $em) {
//
//    }

}
