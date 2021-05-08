<?php

use App\controllers\ObrasController;

require_once '../config/loader.php';
//require "obras_materiales.php";

$conection = new mysqli("localhost", "root", "", "pruebaa");
            //aqui tambien puede ir el if del $_server            
            //el que funciona
            $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM materiales");
			//$sql_registe = mysqli_query($conection,"select materiales.codigo, empleados.nombre, inventario.descripcion, obras.nombre_obra, materiales.cantidad from materiales inner join empleados on materiales.empleado_cod = empleados.codigo inner join inventario on materiales.inventario_cod = inventario.codigo inner join obras on materiales.obras_cod = obras.codigo WHERE obras_cod = $id");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $texto = $_POST["texto"];
                //el que funciona
				//$query = mysqli_query($conection,"select codigo,empleado_cod,cod_barras,inventario_cod,cantidad,obras_cod FROM materiales where inventario_cod like '" . $texto . "%' and obras_cod = $id LIMIT $desde,$por_pagina");
                $query = mysqli_query($conection,"select empleados.nombre as empleado_nom, inventario.descripcion as inventario_des, obras.nombre_obra as obras_nom, materiales.cantidad as materiales_can from materiales inner join empleados on materiales.empleado_cod = empleados.codigo inner join inventario on materiales.inventario_cod = inventario.codigo inner join obras on materiales.obras_cod = obras.codigo WHERE obras_cod = $var LIMIT $desde,$por_pagina");
				mysqli_close($conection);
				$tmp = "<table class='table table-striped table-lg' id = 'table_id'><thead class='table-info'><tr><th width = '25%'>Empleado</th><th width = '25%'>Descripcion</th><th width = '25%'>Nombre de la obra</th><th width = '10%'>Cantidad</th><tr></thead>";

				$result = mysqli_num_rows($query);
				if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
                    //el que funciona
                    $tmp .= "<tr><td>" . $data['empleado_nom'] . "</td><td>" . $data['inventario_des'] . "</td><td>" . $data['obras_nom'] ."</td><td>" . $data['materiales_can'] . "</td><td><button type='button' class='btn btn-success editButton'>Editar</button></td><td><button type='button' class='btn btn-danger eliminar'>Eliminar</button></td></tr>";
                    //$tmp .= "<tr><td>" . $data['empleado_cod'] . "</td><td>" . $data['cod_barras'] . "</td><td>" . $data['inventario_cod'] . "</td><td>" . $data['cantidad'] ."</td><td><button type='button' class='btn btn-success editButton'>Editar</button></td><td><button type='button' class='btn btn-danger eliminar'>Eliminar</button></td></tr>";
				}
				$tmp .= "</table>";
				echo $tmp;

            }
        }

?>
