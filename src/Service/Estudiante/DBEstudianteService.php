<?php

namespace App\Service\Estudiante;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Estudiante;
use App\Entity\Sede;
use App\Entity\Grado;
use App\Entity\Grupo;


class DBEstudianteService{

    private $em;
    private $contador_estudiantes_no_ingresados;
    private $contador_estudiantes_ingresados;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function insertarEstudiantes($estudiantes)
    {   
        foreach($estudiantes as $dato){
            $estudiante = $this->em->getRepository(Estudiante::class)->findOneBy(['documento' => $dato['documento']]);
            if($estudiante){
                $this->contador_estudiantes_no_ingresados += 1;
                continue;
            }
            
            //Verificar Sede
            $sede = $this->em->getRepository(Sede::class)->findOneBy(array('nombre' => $dato['sede']));
            if(!$sede){
                $sede = new Sede();
                $sede->setNombre($dato['sede']);
                $this->em->persist($sede);
                $this->em->flush();
            }
            
            //Verificar grado 
            $grado = $this->em->getRepository(Grado::class)->findOneBy([
                'nombre' => $dato['grado'],
                'sede' => $sede]);
            if(!$grado){
                $grado = new Grado();
                $grado->setNombre($dato['grado']);
                $grado->setSede($sede);
                $this->em->persist($grado);
                $this->em->flush();    
            }
                 //Verificar grupo 
                $grupo = $this->em->getRepository(Grupo::class)->findOneBy([
                    'nombre' => $dato['grupo'],
                    'grado' => $grado]);
                if(!$grupo){
                    $grupo = new Grupo();
                    $grupo->setNombre($dato['grupo']);
                    $grupo->setGrado($grado);
                    $this->em->persist($grupo);
                    $this->em->flush();
                }
                
                //Crear estudiante
                $estudiante = new estudiante();
                $estudiante->setNombre($dato['nombre']);
                $estudiante->setDocumento($dato['documento']);
                $estudiante->setGrupo($grupo);
                $this->em->persist($estudiante);
                $this->em->flush();
                $this->contador_estudiantes_ingresados += 1;
        }
        return ['registrados' => $this->contador_estudiantes_ingresados, 
                'no_registrados' => $this->contador_estudiantes_no_ingresados];
     }
     public function getCantidadEstudiantesRegistrados(): ?string{
        return $this->contador_estudiantes_ingresados;
    }
    public function getCantidadEstudiantesNoRegistrados(): ?string{
        return $this->contador_estudiantes_no_ingresados;
    }
}
