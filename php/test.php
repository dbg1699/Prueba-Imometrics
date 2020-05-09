<?php

require 'candidato.php';
require 'municipio.php';

class Test {

    function contar_votos($municipio) {
        $municipio->contar_votos();
    }

    function imprimir_resultados($municipio, $candidato) {
        
        $html = '<table>';
        $html .= '<thead><th>Municipios</th><th>'.$candidato->obtener_nombre(1).'</th><th>'.$candidato->obtener_nombre(2).'</th><th>'.$candidato->obtener_nombre(3).'</th></thead>';
        $html .= '<tbody>';
        foreach ($municipio->votos as $llave => $votos) {
            $html .= '<tr>';
            $html .= '<td>'.$municipio->obtener_nombre($llave).'</td>';
            $html .= '<td>'.$votos[1].'</td>';
            $html .= '<td>'.$votos[2].'</td>';
            $html .= '<td>'.$votos[3].'</td>';
            $html .= '</tr>';
            $this->sumar_votos($candidato, $votos);
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;

    }

    function sumar_votos($candidato, $votos) {
        
        foreach ($candidato->votos as $llave => $valor) {
            $candidato->registrar_votos($llave, $valor += $votos[$llave]);
        }

    }

    function calcular_porcentaje($candidato, $votos) {
        
        $sumatoria = 0;
        foreach ($candidato->votos as $llave => $valor) {
            $sumatoria += $valor;
        }
        return round(($votos / $sumatoria) * 100);

    }

    function imprimir_resultados_porcentaje($candidato) {
        
        $html = '<table>';
        $html .= '<thead><th>Candidato</th><th>Votos</th><th>Porcentaje</th></thead>';
        $html .= '<tbody>';
        foreach ($candidato->votos as $llave => $votos) {
            $html .= '<tr>';
            $html .= '<td>'.$candidato->obtener_nombre($llave).'</td>';
            $html .= '<td>'.$votos.'</td>';
            $html .= '<td>'.$this->calcular_porcentaje($candidato, $votos).'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;

    }

    function imprimir_segunda_vuelta($candidato) {

        $posicion = 1;
        $ganadores = $candidato->votos;
        arsort($ganadores);
        array_pop($ganadores);
        $html = '<table>';
        $html .= '<thead><th>Posición</th><th>Candidato</th></thead>';
        $html .= '<tbody>';
        foreach ($ganadores as $llave => $votos) {
            $html .= '<tr>';
            $html .= '<td>'.$posicion++.'</td>';
            $html .= '<td>'.$candidato->obtener_nombre($llave).'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;

    }

    function imprimir_ganador_municipios($municipio, $candidato) {
    
        $ganadores = $municipio->obtener_ganador_municipios();
        $html = '<table>';
        $html .= '<thead><th>Municipio</th><th>Ganador</th></thead>';
        $html .= '<tbody>';
        foreach ($ganadores as $llave => $ganador) {
            $html .= '<tr>';
            $html .= '<td>'.$municipio->obtener_nombre($llave).'</td>';
            $html .= '<td>'.$candidato->obtener_nombre($ganador).'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    
    }

    function imprimir_mas_votadores($municipio) {

        $top = $municipio->obtener_mas_votadores();
        $html = '<table>';
        $html .= '<thead><th>Municipio</th><th>Votos</th></thead>';
        $html .= '<tbody>';
        foreach ($top as $llave => $votos) {
            $html .= '<tr>';
            $html .= '<td>'.$municipio->obtener_nombre($llave).'</td>';
            $html .= '<td>'.$votos.'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;

    }

    function imprimir_menos_votadores($municipio) {

        $top = $municipio->obtener_menos_votadores();
        $html = '<table>';
        $html .= '<thead><th>Municipio</th><th>Votos</th></thead>';
        $html .= '<tbody>';
        foreach ($top as $llave => $votos) {
            $html .= '<tr>';
            $html .= '<td>'.$municipio->obtener_nombre($llave).'</td>';
            $html .= '<td>'.$votos.'</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;

    }

}

$test = new Test();
$municipio = new Municipio();
$candidato = new Candidato();
$test->contar_votos($municipio);
echo "a) Votos obtenidos en cada municipio por los 3 candidatos";
echo "<br><br>";
echo $test->imprimir_resultados($municipio, $candidato);
echo "<br><br>";
echo "b) Total de votos recibidos por candidato";
echo "<br><br>";
echo $test->imprimir_resultados_porcentaje($candidato);
echo "<br><br>";
echo "c) Candidatos que pasan a segunda vuelta";
echo "<br><br>";
echo $test->imprimir_segunda_vuelta($candidato);
echo "<br><br>";
echo "d) Ganador en cada municipio";
echo "<br><br>";
echo $test->imprimir_ganador_municipios($municipio, $candidato);
echo "<br><br>";
echo "e) Municipios con mayor cantidad de votos";
echo "<br><br>";
echo $test->imprimir_mas_votadores($municipio);
echo "<br><br>";
echo "e) Municipios con menor cantidad de votos";
echo "<br><br>";
echo $test->imprimir_menos_votadores($municipio);
?>