<?php

namespace App\Models;

class obras extends Conexion {

    public function obtener() {
        $sql = "select *from obras";
        $recurso = $this->_conn->prepare($sql);
        $recurso->execute();
        $filas = $recurso->fetchAll(2);
        return $filas;
    }

    public function nombre_obra($codigo){
        $sql = "select nombre_obra from obras where codigo = ?;";
        $recurso = $this->_conn->prepare($sql);
        $recurso->bindParam(1, $codigo);
        $recurso->execute();
        $resultado = $recurso->fetchAll(2);
        //exit();
        return $resultado;
    }

    public function insertar_obra($nombre_obra, $fecha_inicio, $fecha_final, $estado, $materiales, $herramientas,$empleados) {
        //deberia ser el codigo de abajo pero por problemas de llaves foraneas no deja agregar, seria dejar nulos los valores de las llaves foraneas por ahora mientras se soluciona....
        //$sql = "INSERT INTO obras(nombre_obra,fecha_inicio,fecha_finalizacion,estado,materiales_cod,herramientas_cod,empleados_cod) VALUES ('{$nombre_obra}','{$fecha_inicio}','{$fecha_final}','{$estado}','{$materiales}','{$herramientas}','{$empleados}');";
        $sql = "INSERT INTO obras(nombre_obra,fecha_inicio,fecha_finalizacion,estado,materiales_cod,herramientas_cod,empleados_cod) VALUES ('{$nombre_obra}','0000-00-00','0000-00-00','{$estado}',null,null,null);";
        $recurso = $this->_conn->prepare($sql);
        $resultado = $recurso->execute();
        return $resultado;
    }

    public function editar_obra($codigo, $marca, $referencia, $descripcion, $codBarras, $cantidad, $precio) {
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
