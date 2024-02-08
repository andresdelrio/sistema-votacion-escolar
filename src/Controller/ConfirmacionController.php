<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmacionController extends AbstractController
{
    #[Route('/confirmacion', name: 'app_confirmacion')]
    public function index(Request $request): Response
    {

        $confirmacion = $request->getSession()->get('confirmacion');
        $request->getSession()->clear();
        return $this->render('confirmacion/confirmacion.html.twig', [
            'confirmacion' => $confirmacion
        ]);


        return $this->render('confirmacion/index.html.twig', [
            'controller_name' => 'ConfirmacionController',
        ]);
    }
}
