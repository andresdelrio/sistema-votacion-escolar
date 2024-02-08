<?php

namespace App\Controller;

use App\Service\VotacionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipacionController extends AbstractController
{
    #[Route('/participacion', name: 'app_participacion')]
    public function index(VotacionService $votacionService): Response
    {
        
            $votacionService->consultar();
                  
    
            return $this->render('participacion/participacion.html.twig', [
                'Si_voto' => $votacionService->getSiVoto(),
                'No_voto' => $votacionService->getNoVoto(),
            ]);
    }
}
