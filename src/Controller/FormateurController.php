<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/cree", name="cree")
     */
    public function cree()
    {
        return $this->render('formateur/cree.html.twig');
    }
}
