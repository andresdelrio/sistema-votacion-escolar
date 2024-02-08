<?php

namespace App\Controller;

use App\Repository\CandidatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TarjetonController extends AbstractController
{
    #[Route('/tarjeton', name: 'app_tarjeton')]
    public function index(Request $request, CandidatoRepository $estudianteRepository): Response
    {
        if($request->getSession()->get('validador') && $request->getSession()->get('estudiante')){           
            $candidatos = $estudianteRepository->findAll();
            return $this->render('tarjeton/index.html.twig', [
                'candidatos' => $candidatos
            ]);     
        }else{
            return $this->render('confirmacion/confirmacion.html.twig',[
                'confirmacion' => 'Para poder votar debes con tu código qr o con tu número de documento de identidad.'
                ]); 
        } 
    }
}
