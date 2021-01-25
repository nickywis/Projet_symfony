<?php

namespace App\Controller;

use App\Entity\Acteurs;
use App\Entity\Films;
use App\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    /**
     * @Route("/films", name="films")
     */
    public function index(): Response
    {
        $films = $this->getDoctrine()
        ->getRepository(Films::class)
        ->findAll();
    
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'films'           => $films   
        ]);
    }



    /**
     * @Route("/films/creer", name="films_create")
     */
    public function create(Request $request): Response
    { if ($request->isMethod("POST")){
        $titre = $request->get('titre');
        $resume = $request->get('resume');
        $annee_sortie = $request->get('annee_sortie');
       
        $genre_id = $request->request->get('genre');
        $genre = $this->getDoctrine()
        ->getRepository(Genre::class)
        ->find($genre_id);

        $acteurs_id = $request->request->get('acteurs');
        $genre = $this->getDoctrine()
        ->getRepository(Acteurs::class)
        ->find($acteurs_id);


        var_dump([
                $titre, 
                $resume, 
                $annee_sortie
                ]);

        $film = new Films;
        $film->setTitre($titre);
        $film->setResume($resume);
        $film->setAnneeSortie($annee_sortie);
        $film->setGenre($genre);

        $em = $this->getDoctrine()->getManager();
        $em->persist($film);
        $em->flush();

        return $this->redirectToRoute('films');
    }

        $genres = $this->getDoctrine()
        ->getRepository(Genre::class)
        ->findAll();
    
        return $this->render('films/create.html.twig', [
            'controller_name' => 'FilmsController',
            'genres' => $genres    
        ]);
      

        
    }     
}