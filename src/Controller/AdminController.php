<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/add", name="admin")
     */
    public function addService(ServiceRepository $repos)
    {
        $services =$repos ->findAll();
        return $this->render('admin/index.html.twig', [
            '$services' => $services,
        ]);
    }
}
