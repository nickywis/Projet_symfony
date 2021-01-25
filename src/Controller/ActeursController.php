<?php

namespace App\Controller;

use App\Entity\Acteurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActeursController extends AbstractController
{
    /**
     * @Route("/acteurs", name="acteurs")
     */
    public function index(): Response
    {
        $acteurs = $this->getDoctrine()
        ->getRepository(Acteurs::class)
        ->findAll();

        return $this->render('acteurs/index.html.twig', [
            'controller_name' => 'ActeursController',
            'acteurs'           => $acteurs 
        ]);
    }

    /**
     * @Route("/acteurs/creer", name="acteurs_create")
     */
    public function create(Request $request): Response
    {if($request->isMethod("POST")){
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $date_de_naissance = $request->request->get('date_de_naissance');
        $date_de_mort = $request->request->get('date_de_mort');

       $acteur = new Acteurs;
       $acteur->setNom($nom);
       $acteur->setPrenom($prenom);
       $acteur->setDateDeNaissance(new \DateTime($date_de_naissance));
       if($date_de_mort!= "" ){
        $date_de_mort = new \DateTime($date_de_mort);
    }
    else{
        $date_de_mort= null;
    }

       $em = $this->getDoctrine()->getManager();
        $em->persist($acteur);
        $em->flush();

        return $this->redirectToRoute('acteurs');
    }
        return $this->render('acteurs/create.html.twig', [
            'controller_name' => 'ActeursController',  
        ]);
        
    }

       /**
     * @Route("/acteurs/{id}/editer", name="acteurs_edit")
     */
    public function edit($id,Request $request): Response
    { 
        $acteur = $this->getDoctrine()
        ->getRepository(Acteurs::class)
        ->find($id);

        if ($request->isMethod("POST")){
        $nom = $request->request->get('nom');

        $acteur->setNom($nom);


        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('acteurs');
    }

    
        return $this->render('acteurs/edit.html.twig', [
            'controller_name' => 'ActeursController',
            'acteur' => $acteur
        ]);

        

        
    }

           /**
     * @Route("/acteurs/{id}/supprimer", name="acteurs_delete")
     */
    public function delete($id,Request $request): Response
    { 
        $acteur = $this->getDoctrine()
        ->getRepository(Acteurs::class)
        ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($acteur);
        $em->flush();

        return $this->redirectToRoute('acteurs');
    }


        
}


