<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Estudiante;
use App\Entity\Sufragante;

class VotacionService {

    private $em, $Si_voto, $No_voto = null;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function consultar(){
        $estudiantes = $this->em->getRepository(Estudiante::class)->findAll();
        $sufragios = $this->em->getRepository(Sufragante::class)->findAll();
         
        
        foreach ($estudiantes as $est){
            
            
            $si_registra_voto = null;

            foreach ($sufragios as $index => $sufragio){
                if($est->getId() === $sufragio->getEstudiante()->getId()){
                    $si_registra_voto = true;
                    unset($sufragios[$index]);
                } 
            }
            if($si_registra_voto){
                $grupo = $est->getGrupo();
                $grado = $grupo->getGrado();
                $sede = $grado->getSede();
                $this->Si_voto[] = array($est, $grado->getNombre(), $sede->getNombre());
            
            }else{
                $grupo = $est->getGrupo();
                $grado = $grupo->getGrado();
                $sede = $grado->getSede();
                $this->No_voto[] = array($est, $grado->getNombre(), $sede->getNombre() );
            }  
        }
    }


    public function getSiVoto(): ?array{
        
        return $this->Si_voto;
    }

    public function getNoVoto(): ?array{
        return $this->No_voto;
    }
}