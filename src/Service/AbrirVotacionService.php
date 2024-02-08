<?php 

namespace App\Service;

class AbrirVotacionService {

    private $permitidoVotar = null;
    private $votacion_cerrada = null;


    public function revisar_fecha(\DateTime $fecha): bool{
   
        if($fecha > new \DateTime($_ENV['INICIO_VOTACION'], new \DateTimeZone('America/Bogota'))){
            $this->permitidoVotar= true;
        }else
        {
            $this->permitidoVotar = false;
        }
        return $this->permitidoVotar;
    }


    public function votacion_cerrada(\DateTime $fecha): bool{
    
        if($fecha > new \DateTime($_ENV['FIN_VOTACION'], new \DateTimeZone('America/Bogota'))){
            $this->votacion_cerrada= true;
        }else
        {
            $this->votacion_cerrada = false;
        }
        return $this->votacion_cerrada;
    }
    
}