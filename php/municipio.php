<?php

class Municipio {

    public $votos;
    public $municipios;

    function __construct() {

        $this->votos = [
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => [],
            7 => [],
            8 => [],
            9 => [],
            10 => []
        ];
        $this->municipios = [
            1 => "Medellin",
            2 => "Bello",
            3 => "Sabaneta",
            4 => "Itagui",
            5 => "Envigado",
            6 => "Copacabana",
            7 => "Caldas",
            8 => "Estrella",
            9 => "Barbosa",
            10 => "Santa Elena"
        ];

    }

    function contar_votos() {

        foreach ($this->municipios as $llave => $valor) {
            $this->votos[$llave] = [
                1 => random_int(0, 25000),
                2 => random_int(0, 25000),
                3 => random_int(0, 25000)
            ];
        }

    }

    function obtener_ganador_municipios() {

        $aux_votos = [];
        $ganador = 0;
        $ganadores = [];
        foreach ($this->votos as $llave => $valor) {
            $aux_votos = $valor;
            arsort($aux_votos);
            $ganador = array_key_first($aux_votos);
            $ganadores += [$llave => $ganador];
        }
        return $ganadores;

    }

    function obtener_nombre($llave) {

        return $this->municipios[$llave];

    }

    function obtener_mas_votadores() {

        $suma_votos = 0;
        $top_votos = [];
        $top_dos = [];
        $contador = 0;
        foreach ($this->votos as $llave => $valor) {
            $suma_votos = 0;
            for ($i = 0; $i < sizeof($valor); $i++) {
                $suma_votos += $valor[$i+1];
            }
            $top_votos += [$llave => $suma_votos];
        }
        arsort($top_votos);
        foreach ($top_votos as $llave => $valor) {
            $top_dos += [$llave => $valor];
            $contador++;
            if ($contador === 2) break;
        }
        return $top_dos;

    }

    function obtener_menos_votadores() {

        $suma_votos = 0;
        $top_votos = [];
        $top_dos = [];
        $contador = 0;
        foreach ($this->votos as $llave => $valor) {
            $suma_votos = 0;
            for ($i = 0; $i < sizeof($valor); $i++) {
                $suma_votos += $valor[$i+1];
            }
            $top_votos += [$llave => $suma_votos];
        }
        asort($top_votos);
        foreach ($top_votos as $llave => $valor) {
            $top_dos += [$llave => $valor];
            $contador++;
            if ($contador === 2) break;
        }
        return $top_dos;

    }

}

?>