<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SubirArchivoType;
use App\Service\Estudiante\RegistrarEstudianteService;


class EstudianteController extends AbstractController
{
    #[Route('/registrar_estudiantes', name: 'app_registrar_estudiantes')]
    public function registrar_estudiantes(Request $request, RegistrarEstudianteService $registrarService): Response
    {
        $form = $this->createForm(SubirArchivoType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            if($file){
                $registros = $registrarService->registrarEstudiantes($file);
                return $this->render('estudiante/resultado_registro_estudiantes.html.twig', [
                    'form' => $form->createView(),
                    'registros' => $registros,
                ]);
            }

            return $this->redirectToRoute('app_registrar_estudiantes');
        }

        return $this->render('estudiante/registro_estudiantes.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}