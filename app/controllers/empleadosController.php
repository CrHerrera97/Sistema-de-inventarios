<?php

namespace App\controllers;

use App\Models\empleados;

class EmpleadosController {
    
    public function getEmpleados(){
        $objEmpleados = new empleados();
        $filas = $objEmpleados->obtener();
        return $filas;
    }
    
}
