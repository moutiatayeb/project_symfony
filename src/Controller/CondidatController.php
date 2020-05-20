<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CondidatController extends AbstractController
{
    /**
     * @Route("/condidat", name="condidat")
     */
    public function index()
    {
        return $this->render('condidat/index.html.twig');
    }
}
