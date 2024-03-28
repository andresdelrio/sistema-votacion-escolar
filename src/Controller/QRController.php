<?php

namespace App\Controller;

use App\Entity\Sede;
use App\Entity\Estudiante;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QRController extends AbstractController
{
    #[Route('/qr', name: 'app_qr')]
    public function index(EntityManagerInterface $em): Response
    {
        $qrEstudiante = $em->getRepository(Estudiante::class)->findAll();
        return $this->render('qr/index.html.twig',[
            'qr'=>$qrEstudiante
        ]);
    }

    #[Route('/qr/{sede}', name: 'app_qr_sede')]
    public function sede(EntityManagerInterface $em, $sede): Response
    {
        $sede = $em->getRepository(Sede::class)->findBy(['nombre' => $sede]);
        if(!$sede)
            return $this->redirectToRoute('app_qr');
        $sede = $sede[0]->getNombre();
        $qrEstudiante = $em->getRepository(Estudiante::class)->findBySede($sede);        
        return $this->render('qr/index.html.twig',[
            'qr'=>$qrEstudiante,
            'sede'=>$sede
        ]);
    }
}