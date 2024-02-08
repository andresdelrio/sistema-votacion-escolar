<?php

namespace App\Service;

class LeerArchivoService{

    public function leer($file): array
    {
        $data = [];
        //determinar extension del archivo
        $extension = $file->getClientOriginalExtension();

        if($extension == 'csv'){
        $data = $this->leerCSV($file);
        return $data;
        }elseif($extension == 'xlsx' || $extension == 'xls'){
            $data = $this->leerXLSX($file);
            return $data;
        }else{
            return $data = [];
        }
    }

    public function leerCSV($file): array
    {
        $objeto = [];
        if(($gestor = fopen($file, "r")) !== FALSE){
            while(($datos = fgetcsv($gestor, 0, ";")) !== FALSE){
                $objeto[] = $datos;
            }
            fclose($gestor);
        }
        return $objeto;
    }

    public function leerXLSX($file): array
    {
        $objeto = [];
        $file = fopen($file, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $objeto[] = $line;
        }
        fclose($file);
        return $objeto;
    }
}