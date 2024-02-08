<?php

namespace App\Service\Estudiante;


class PrepararDatosEstudianteService
{
    
        public function prepararEstudiantes($data): array
        {
            
            $estudiantes = [];
            foreach ($data as $key => $estudiante)
            {
                
                $estudiantes[] = [
                    'sede' => $estudiante[0],
                    'grado' => $estudiante[1],
                    'grupo' => $estudiante[2],
                    'nombre' => $estudiante[3],
                    'documento' => $estudiante[4],
                ];
            }
            return $estudiantes;
        }
}