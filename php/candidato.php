<?php

class Candidato {

    public $votos;
    public $candidatos;
    
    function __construct() {
        
        $this->candidatos = [
            1 => "Daniela Benitez",
            2 => "Manuel Bolivar",
            3 => "Santiago Rodriguez"
        ];
        $this->votos = [
            1 => 0,
            2 => 0,
            3 => 0
        ];

    }

    function obtener_nombre($llave) {
        return $this->candidatos[$llave];
    }

    function registrar_votos($llave, $numero_votos) {
        $this->votos[$llave] = $numero_votos;
    }

}

?>