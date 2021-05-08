<?php

namespace App\controllers;

use App\Models\obras;

class ObrasController {
    
    public function getObras(){
        $objObras = new obras();
        $filas = $objObras->obtener();
        return $filas;
    }
    
    public function grabarObras($nombre_obra,$fecha_inicio,$fecha_final,$estado,$materiales,$herramientas,$empleados){
        $objObras = new obras();
        $filas = $objObras->insertar_obra($nombre_obra, $fecha_inicio, $fecha_final, $estado, $materiales, $herramientas,$empleados);
        return $filas;
    }

    public function nombre_obra($codigo){
        $objObras = new obras();
        $filas = $objObras->nombre_obra($codigo);
        return $filas;
    }
    
}
