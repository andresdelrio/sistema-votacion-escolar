<?php

namespace App\Controller;

use App\Entity\Voto;
use App\Entity\Estudiante;
use App\Entity\Sufragante;
use App\Repository\CandidatoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrarVotoController extends AbstractController
{
    #[Route('/registrarvoto', name: 'app_registrar_voto')]
    public function index(Request $request, CandidatoRepository $candidatoRepository, EntityManagerInterface $em): Response
    {
        $eleccion = $request->request->get('vote');
        if ($eleccion) {   
            $candidato = $candidatoRepository->find($eleccion);
            if (!$candidato) {
                // Manejar el caso en que el candidato no se encuentre
                return $this->render('confirmacion/error.html.twig', [
                    'error' => 'Candidato no encontrado.'
                ]);
            }

            $registroVoto = new Voto();
            $registroVoto->setCandidato($candidato);
            $em->persist($registroVoto);
            
            //Registrar sufragio del estudiante que votó
            $estudiante = $em->getRepository(Estudiante::class)->find($request->getSession()->get('estudiante'));  
            $registroSufragio = new Sufragante();
            $registroSufragio->setEstudiante($estudiante);
            $request->getSession()->clear();
            $em->persist($registroSufragio);
            $em->flush();
        return $this->render('confirmacion/confirmacion.html.twig',[
            'confirmacion' => 'Tu voto ha sido registrado. Gracias por participar'
            ]);
        }else{
            return $this->render('confirmacion/confirmacion.html.twig',[
                'confirmacion' => 'No se ha registrado el voto, por favor intenta nuevamente'
                ]); 
            }
        // return $this->render('registrar_voto/index.html.twig', [
        //     'controller_name' => 'RegistrarVotoController',
        // ]);
    }
}
