<?php

namespace App\Controller;

use App\Entity\Idee;
use App\Form\IdeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }




        /*
        // return a view (page)
        return $this->render('wish/form.twig', [
            "ideeForm" => $ideeForm->createView()
        ]);
        */




}
