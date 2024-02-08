<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Form\CargarCandidatoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SubirCandidatoController extends AbstractController
{
    #[Route('/subir_candidato', name: 'app_subir_candidato')]
    public function index(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $candidato = new Candidato();
        $form = $this->createForm(CargarCandidatoType::class, $candidato);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $nombre = $form->get('nombre')->getData();
            $documento = $form->get('documento')->getData();
            $slogan = $form->get('eslogan')->getData();
            $candidato->setNombre($nombre);
            $candidato->setDocumento($documento);
            $candidato->setEslogan($slogan);
            $imagen = $form->get('imagen')->getData();
            if($imagen) {
                $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();
                try {
                    $imagen->move(
                        $this->getParameter('imagenes_candidatos'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Error al subir la imagen');
                }
                $candidato->setImagen($newFilename);
            }
            $entityManager->persist($candidato);
            $entityManager->flush();
            $this->addFlash('success', 'Candidato creado correctamente');
            return $this->redirectToRoute('app_subir_candidato');
        }

        return $this->render('subir_candidato/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
