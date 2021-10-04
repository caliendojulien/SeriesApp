<?php

namespace App\Controller;

use App\Entity\Saison;
use App\Form\SaisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaisonController extends AbstractController
{
    /**
     * @Route("saison/ajouter", name="saison_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $saison = new Saison();
        $formSaison = $this->createForm(SaisonType::class, $saison);
        // Traitement du formulaire qui redirige vers la liste des series
        $formSaison->handleRequest($request);
        if ($formSaison->isSubmitted() && $formSaison->isValid()) {
            $em->persist($saison);
            $em->flush();
            return $this->redirectToRoute('serie_index');
        }
        return $this->renderForm('saison/ajouter.html.twig',
            compact("formSaison")
        );
    }
}
