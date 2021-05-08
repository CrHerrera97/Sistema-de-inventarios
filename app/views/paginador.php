<?php

use App\Models\inventario;

include '../models/conexion.php';

$conection = new mysqli("localhost", "root", "", "pruebaa");
            //para arreglar el problema de la variable indefinida creo que es necesario cambiar nombre cuando se envia la variable por el metodo post
            //aqui tambien puede ir el if del $_server
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM inventario");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

            $por_pagina = 5;

			if(empty($_GET['pagina']))
			{
                //$pagina = $_GET["pagina"];
                $pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$texto = $_POST["texto"];
				$query = mysqli_query($conection,"select codigo,marca,referencia,descripcion,codigo_barras,cantidad,precio FROM inventario where descripcion like '" . $texto . "%' LIMIT $desde,$por_pagina");

				mysqli_close($conection);
				$tmp = "<table class='table table-striped table-lg' id = 'table_id'><thead class='table-info'><tr><th width = '10%'>Codigo</th><th width = '25%'>Marca</th><th width = '25%'>Referencia</th><th width = '25%'>Descripcion</th><th width = '25%'>Codigo_barras</th><th width = '25%'>Cantidad</th><th width = 10%'>Precio</th><tr></thead>";

				$result = mysqli_num_rows($query);
				if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					$tmp .= "<tr><td>" . $data['codigo'] . "</td><td>" . $data['marca'] . "</td><td>" . $data['referencia'] . "</td><td>" . $data['descripcion'] . "</td><td>" . $data['codigo_barras'] . "</td><td>" . $data['cantidad'] . "</td><td>" . $data['precio'] . "</td><td><button type='button' class='btn btn-success editButton'>Editar</button></td><td><button type='button' class='btn btn-danger eliminar'>Eliminar</button></td></tr>";
				}
				$tmp .= "</table>";
				echo $tmp;

			}
		 
}
?>
<script>
            //esta es una funcion que me llama a el modal de bootstrap cuando hago click en editar
            $(document).ready(function () {
                $('.editButton').on('click', function () {
                    $('#editModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();
                    console.log(data);

                    $('#codigo').val(data[0]);
                    $('#marca').val(data[1]);
                    $('#referencia').val(data[2]);
                    $('#descripcion').val(data[3]);
                    $('#codigo_barras').val(data[4]);
                    $('#cantidad').val(data[5]);
                    $('#precio').val(data[6]);

                });
            });
        </script>

        <!-- funcion javascript que me permite eliminar del inventario -->
        <script>
            $(document).ready(function () {
                $('.eliminar').on('click', function () {
                    $('#borrarInventario').modal('show');
                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();
                    console.log(data);

                    $('#codi').val(data[0]);
                });
            });
        </script>