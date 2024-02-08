<?php

namespace App\Controller;

use App\Entity\Estudiante;
use App\Service\AbrirVotacionService;
use App\Repository\SufraganteRepository;
use App\Repository\EstudianteRepository;
use App\Form\IngresoParaVotarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    #[Route('/', name: 'app_inicio')]
    public function index(Request $request, AbrirVotacionService $abrirVotacion, 
                            SufraganteRepository $sufraganteRepository,
                            EstudianteRepository $estudianteRepository): Response
    {
        $fecha_inicio = new \DateTime($_ENV['INICIO_VOTACION'], new \DateTimeZone('America/Bogota'));
        $fecha_fin = new \DateTime($_ENV['FIN_VOTACION'], new \DateTimeZone('America/Bogota'));
     
 
         if(!($abrirVotacion->revisar_fecha(new \DateTime('NOW', new \DateTimeZone('America/Bogota')))))
         {
             return $this->render('confirmacion/abrir_voto.html.twig', [
                 'mensaje' => 'Las votaciones digitales inician el '. $fecha_inicio->format('d-m-y') .' a las ' . $fecha_inicio->format('H:i'),
                 'fecha_cierre' =>$fecha_inicio->format('M d, Y H:i:s'),
             ]);
         }
 
         if(($abrirVotacion->votacion_cerrada(new \DateTime('NOW', new \DateTimeZone('America/Bogota')))))
         {
             return $this->render('confirmacion/votacion_cerrada.html.twig', [
                 'mensaje' => 'La votación terminó el '. $fecha_fin->format('d-m-y').' a las ' . $fecha_fin->format('H:i')
             ]);
         }
 
         $request->getSession()->clear();
         $estudiante = new Estudiante();
 
         $form = $this->createForm(IngresoParaVotarType::class, $estudiante);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $documento = $form->get('documento')->getData();
             $estudiante = $estudianteRepository->findOneBy(array('documento' => $documento));
             
             
             if($estudiante){
                 $sufragio = $sufraganteRepository->findOneBy(array('estudiante'=>$estudiante->getId()));
                 //dump($sufragio->getEstudiante());
                 //dump($estudiante);
                 if(!$sufragio){
                     $validador = '_$sfGGHrGkGDSw_-0827340*13+84528736_348';
                     $sesion = $request->getSession();
                     $sesion->set('validador', $validador);
                     $sesion->set('estudiante', $estudiante->getId() );
                     
                     return $this->redirectToRoute('app_tarjeton');
                 }else{
                     $sesion = $request->getSession();
                     $sesion->set('confirmacion',$estudiante->getNombre() .' ya has votado');
                     return $this->redirectToRoute('app_confirmacion');
                 }
 
             }else{
 
                return $this->render('confirmacion/confirmacion.html.twig',[
                 'confirmacion' => 'No se ha encontrado el estudiante, por favor reportálo con tu profesor'
                 ]);
             }
             
 
         }
 
         return $this->render('inicio/inicio.html.twig', [
             'form' => $form->createView()
         ]);
    }
}
