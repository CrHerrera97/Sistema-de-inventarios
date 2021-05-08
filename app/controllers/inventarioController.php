<?php

namespace App\controllers;

use App\Models\inventario;

class InventarioController {
    
    public function getInventario(){
        $objInventario = new inventario();
        $filas = $objInventario->obtener();
        return $filas;
    }
    
    public function grabarInventario($marca,$referencia,$descripcion,$codBarras,$cantidad,$precio){
        $objInventario = new inventario();
        $filas = $objInventario->insertar($marca, $referencia, $descripcion, $codBarras, $cantidad, $precio);
        return $filas;
    }
    
    public function editarInventario($codigo,$marca,$referencia,$descripcion,$codBarras,$cantidad,$precio){
        $objInventario = new inventario();
        $filas = $objInventario->editar_inventario($codigo, $marca, $referencia, $descripcion, $codBarras, $cantidad, $precio);
        return $filas;
    }
    
    public function borrarInventario($codigo){
        $objInventario = new inventario();
        $filas = $objInventario->borrar_inventario($codigo);
        return $filas;
    }

        public function getInventarioCodigo($codigo){
        $objInventario = new inventario();
        $filas = $objInventario->obtenerXcodigo($codigo);
        return $filas;
    }
}
