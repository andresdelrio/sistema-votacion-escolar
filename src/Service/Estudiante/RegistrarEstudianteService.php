<?php

namespace App\Service\Estudiante;

use App\Service\LeerArchivoService;
use App\Service\Estudiante\PrepararDatosEstudianteService;
use App\Service\Estudiante\DBEstudianteService;

class RegistrarEstudianteService
{

    private $leerArchivoService;
    private $dbService;
    private $prepararDatosService;

    public function __construct(LeerArchivoService $leerArchivoService, PrepararDatosEstudianteService $prepararDatosService, DBEstudianteService $dbService)
    {
        $this->leerArchivoService = $leerArchivoService;
        $this->prepararDatosService = $prepararDatosService;
        $this->dbService = $dbService;
    }

    public function registrarEstudiantes($file): array
    {

        $data = $this->leerArchivoService->leer($file);
        $data = $this->prepararDatosService->prepararEstudiantes($data);
        $registros = $this->dbService->insertarEstudiantes($data);
        return $registros;
    
    }
}
