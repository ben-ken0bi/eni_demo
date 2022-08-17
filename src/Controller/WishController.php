<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Idee;
use App\Form\IdeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="app_wish")
     */
    public function wish(): Response
    {
        return $this->render('wish/wish.twig', [
            'controller_name' => 'WishController',
        ]);
    }

//    /**
//     * @Route("/create-idea", name="app_home")
//     */
//    public function creatIdea() : Response{
//
////        Création de l'idée 1
//        $idee1 = new Idee();
//        $idee1->setTitle("Parachute");
//        $idee1->setAuthor("Ben");
//
////        Traitement avec l'ORM
//        $em = $this->getDoctrine()->getManager();
//
//        $em->persist($idee1);
//        $em->flush();
//
//    }

    /**
     * @Route("/idee-list", name="app_home")
     */
    public function ideeListe() : Response{

        // Repo Article
        $repoIdee = $this->getDoctrine()->getRepository(Idee::class); // Récuperer l'entity manager doctrine

        // Je récupere un article
        $ideeList = $repoIdee->findAll();

        return $this->render('wish/wish.twig', [
            "ideeList" => $ideeList,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_detail")
     */
    public function ideeDetail($id): Response{

        // Repo idée
        $repoIdee = $this->getDoctrine()->getRepository(Idee::class); // récup du em doctrine

        $idee = $repoIdee->find($id);

        return $this->render('wish/detail.twig', [
            "idee" => $idee,
        ]);
    }

    /**
     * @Route("/idee-form", name="app_idee_form")
     */
    public function showForm(Request $request): Response
    {
        // instance vide
        $idee = new Idee();
        // creation of form
        $ideeForm = $this->createForm(IdeeType::class, $idee);


        $category = new Category();
        $idee->setCategory($category);

        // put any default parameters here

        $ideeForm->handleRequest($request);

        if ($ideeForm->isSubmitted()) {
            // traitement
            $em = $this->getDoctrine()->getManager();
            $em->persist($idee);
            $em->flush();



            $em->persist($category);
            $this->addFlash('success', 'idée a bien été ajoutée');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('wish/form.twig', [
            "ideeForm" => $ideeForm->createView()
        ]);
    }



}


/*
//        Création de l'idée 1
$idee1 = new Idee();
$idee1->setTitle("Parachute");
$idee1->setAuthor("Ben");

//        Traitement avec l'ORM
$em = $this->getDoctrine()->getManager();

$em->persist($idee1);
$em->flush();
*/
