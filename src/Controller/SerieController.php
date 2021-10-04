<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SerieController extends AbstractController
{
    /**
     * @Route("/", name="serie_index")
     */
    public function index(SerieRepository $repository): Response
    {
        $liste = $repository->findAll();
        return $this->render('serie/index.html.twig',
            compact("liste")
        );
    }

    /**
     * @Route("/details/{id}", name="serie_details")
     */
    public function details(Serie $serie): Response
    {
        return $this->render('serie/details.html.twig',
            compact("serie")
        );
    }

    /**
     * @Route("/ajouter", name="serie_ajouter")
     */
    public function ajouter(
        Request                $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $serie = new Serie();
        $monForm = $this->createForm(SerieType::class, $serie);

        $monForm->handleRequest($request); // Je récupère les données entrées par l'utilisateur

        if ($monForm->isSubmitted() && $monForm->isValid()) {
            $entityManager->persist($serie);
            $entityManager->flush();
            // Message flash
            $this->addFlash("success", "La série a été ajoutée.");
            return $this->redirectToRoute('serie_index');
        }
        /*return $this->render('serie/ajouter.html.twig',
            ["monformulaire" => $monForm->createView()]
        );*/
        return $this->renderForm('serie/ajouter.html.twig',
            compact("monForm")
        );
    }
}
