<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function compte()
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

}
