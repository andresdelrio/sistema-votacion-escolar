<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Candidato;
use App\Entity\Estudiante;
use App\Entity\Voto;


class ResultadosController extends AbstractController
{
    #[Route('/resultados', name: 'app_resultados')]
    public function index(EntityManagerInterface $em): Response
    {
        //Cuántos estudiantes votaron
        $potencial_sufragantes = count($em->getRepository(Estudiante::class)->findAll());

        //Cuantos estuidantes no votaron 

        //Votos de los candidatos

        $numero_candidatos = $em->getRepository(Candidato::class)->findAll();
        //dump($numero_candidatos);
        $votos = $em->getRepository(Voto::class)->findAll();
        //dump(count($numero_candidatos[2]->getVotos()));
        $candidatos_votos = null;
        foreach ($numero_candidatos as $candidato){
            $candidatos_votos[] = $candidato;
        }
        //dump($candidatos_votos);
        

        return $this->render('resultados/resultados.html.twig', [
            'candidatos_votos' => $candidatos_votos,
            'potencial_sufragantes' => $potencial_sufragantes
        ]);
    }
}
