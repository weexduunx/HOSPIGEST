<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use App\utile\MatriculeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedecinController extends AbstractController
{
    /**
     * @Route("/", name="medecin")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Medecin::class);
        $médecins = $repo->findAll();

        return $this->render('medecin/index.html.twig', [
            'controller_name' => 'MedecinController',
            'médecins' => $médecins
        ]);
    }
     /**
     * @Route("/medecin/ajoutMedecin", name="medecin_add")
     */
    public function add(Request $request, MatriculeGenerator $matriculeGenerator,MedecinRepository $medecinRepository)
    {

       
        $medecin = new Medecin();

        $form =$this->createForm(MedecinType::class, $medecin);
        $form ->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()){
           
            $medecin->setMatricule($matriculeGenerator->generate($medecin));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist ($medecin);
            
            $entityManager->flush();
          return $this->redirectToRoute('medecin');

        }


        return $this->render('medecin/ajout.html.twig', [
          'form' => $form->createView(),
          'medecins' => $medecinRepository->findAll(),

    
        ]);
    }
    


}
