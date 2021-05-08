<?php

namespace App\Models;

class inventario extends Conexion {

    public function obtener() {
        $sql = "select *from inventario";
        $recurso = $this->_conn->prepare($sql);
        $recurso->execute();
        $filas = $recurso->fetchAll(2);
        return $filas;
    }

    public function actualizarStock($id,$stockAdescontar){
        $sql = "select cantidad from inventario where id = $id";
        $recurso = $this->_conn->prepare($sql);
        //$recurso->execute();
        $stockActual = 0;
        if($reg = mysqli_fetch_array($recurso)){
            $stockActual = $reg[0];
        }
        $stockActual -= $stockAdescontar;

        $query = "update inventario set cantidad = $stockActual where id = $id";
        $this->_conn->prepare($sql);
    }

    public function insertar($marca, $referencia, $descripcion, $codBarras, $cantidad, $precio) {
        $sql = "INSERT INTO inventario(marca,referencia,descripcion,codigo_barras,cantidad,precio) VALUES ('{$marca}','{$referencia}','{$descripcion}','{$codBarras}','{$cantidad}','{$precio}');";
        $recurso = $this->_conn->prepare($sql);
        $resultado = $recurso->execute();
        return $resultado;
    }

    public function editar_inventario($codigo, $marca, $referencia, $descripcion, $codBarras, $cantidad, $precio) {
        $sql = "UPDATE inventario SET marca = '{$marca}', referencia = '{$referencia}', descripcion = '{$descripcion}', codigo_barras = '{$codBarras}', cantidad = '{$cantidad}', precio = '{$precio}' WHERE codigo = ?;";
        $recurso = $this->_conn->prepare($sql);
        $recurso->bindParam(1, $codigo);
        $recurso->execute();
        $resultado = $recurso->fetchAll(2);

        return $resultado;
    }

    public function borrar_inventario($codigo) {
        $sql = "DELETE FROM inventario WHERE codigo = ?;";
        $recurso = $this->_conn->prepare($sql);
        $recurso->bindParam(1, $codigo);
        $resultado = $recurso->execute();
        //exit();
        return $resultado;
    }


    //actualizar o descontar del inventario...

    public function actualizar_stock($id){
        
    }

    //debemos obtener el codigo para luego si actualizarlo
    public function obtenerXcodigo($codigo) {
        $sql = "SELECT codigo, marca, referencia, descripcion, codigo_barras, cantidad, precio FROM INVENTARIO WHERE codigo = ?;";
        $recurso = $this->_conn->prepare($sql);
        $recurso->bindParam(1, $codigo);
        $recurso->execute();
        $filas = $recurso->fetchAll(2);
    }

    /*
      public function actualizar($nombresede,$codigosede) {
      $sql = "UPDATE sedes SET nombresede=? WHERE codsede = ?;";
      $recurso = $this->_conn->prepare($sql);
      $recurso->bindParam(1, $nombresede);
      $recurso->bindParam(2, $codigosede);
      $recurso->execute();
      $resultado = $recurso->fetchAll(2);
      //Inicio: Depurar código
      //        echo '<pre>';
      //        $recurso->debugDumpParams();
      //        echo '</pre>';
      //        exit();
      //Fin: Depurar código
      return $resultado;
      }

     */
}
