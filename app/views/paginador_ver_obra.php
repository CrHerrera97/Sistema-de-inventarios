<?php

//include '../models/conexion.php';
require_once '../config/loader.php';
//include 'paginador_obra.php';
    $variable = $_GET["id"];

    echo $variable;
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
                $query = mysqli_query($conection,"select empleados.nombre as empleado_nom, inventario.descripcion as inventario_des, obras.nombre_obra as obras_nom, materiales.cantidad as materiales_can from materiales inner join empleados on materiales.empleado_cod = empleados.codigo inner join inventario on materiales.inventario_cod = inventario.codigo inner join obras on materiales.obras_cod = obras.codigo WHERE obras_cod = 2 LIMIT $desde,$por_pagina");
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


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title></title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            
        </head>
        <body class="container"  Onload="buscar_ver_obra();">
        <!-- aqui se va a poner el boton de ingresar un nuevo dato al sistema -->

        <!---MODAL -->
        <!-- Modal para agregar inventario -->

        <div class="container">
            <div class="row">
            <h1 class="col col-4">Sistema de Inventario</h1>
            <div class="col col-6"></div>
            <img class="col col-2" src="../imagenes/logo.jpg" alt="logo rh">
            </div>
            <?php
            require './navBar.php';
            ?>
        </div>
        <br>    
        <section>
            <div id="datos_ver_obras">
                
            </div>
        </section>
        
        <div class="modal fade" id="obraAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Obra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="obra_crear.php" name="form_add" method="post" onsubmit="return valida();">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la obra</label>
                                <input type="text" name="nombre_obra" id="" class="form-control" placeholder="inserte" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Fecha de inicio</label>
                                <input id="date" type="date" name="fecha_inicio" id="" class="form-control" placeholder="inserte" autocomplete="off">
                                <!--<input type="text" name="referencia" id="" class="form-control" placeholder="inserte" autocomplete="off">-->
                            </div>
                            <div class="form-group">
                                <label>Fecha de finalización</label>
                                <input id="date" type="date" name="fecha_final" id="" class="form-control" placeholder="inserte" autocomplete="off">
                                <!--<input type="text" name="descripcion" id="" class="form-control" placeholder="inserte"autocomplete="off">--->
                            </div>
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="estado" id="" class="form-control" placeholder="inserte"autocomplete="off">
                                <option value="1">En ejecucion</option>
                                <option value="2">Terminado</option>
                                <option value="2">Quieta</option>
                            </select>
                                <!--<input type="text" name="codigo_barras" id="" class="form-control" placeholder="inserte"autocomplete="off">-->
                            </div>
                            <div class="form-group">
                                <label>Materiales</label>
                                <input type="text" name="materiales" id="" class="form-control" placeholder="inserte" onkeypress="return soloNumeros(event)" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Herramientas</label>
                                <input type="text" name="herramientas" id="" class="form-control" placeholder="inserte" onkeypress="return soloNumeros(event)"autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Empleados</label>
                                <input type="text" name="empleados" id="" class="form-control" placeholder="inserte" onkeypress="return soloNumeros(event)"autocomplete="off">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="insertar">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--- modal para editar inventario --->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="inventario_editar.php" method="post">
                        <div class="modal-body">

                            <div class="form-group">
                                <input id="codigo" name="codigo" type="hidden"/>
                                <label>Marca</label>
                                <input type="text" name="marca" id="marca" class="form-control" placeholder="Editar">
                            </div>
                            <div class="form-group">
                                <label>Referencia</label>
                                <input type="text" name="referencia" id="referencia" class="form-control" placeholder="Editar">
                            </div>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Editar">
                            </div>
                            <div class="form-group">
                                <label>Codigo de barras</label>
                                <input type="text" name="codigo_barras" id="codigo_barras" class="form-control" placeholder="Editar">
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Editar">
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" name="precio" id="precio" class="form-control" placeholder="Editar">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="update">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--- Fin modal--->
        <div>
            <div class="row">
                <div class="col-md-2">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#obraAdd">
                            Agregar
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="pull-right">
                            <h5>Buscar:</h5><input type="text" id="txtnom" name="txtnom" value="" onkeyup="buscar_ver_obra()" placeholder="Busqueda...">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br>
        

        <div class="row">
        <div class="col-lg-10"></div>

        <div class="modal fade" id="borrarInventario" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="text-danger">Advertencia</span>
                    </div>

                    <div class="modal-body">
                        ¿Está seguro que desea eliminar el registro?<p></p>
                        <span id="codigo" class="text-danger"></span>

                        <form id="frmRemove" method="post" action="inventario_borrar.php">
                            <input id="codi" name="codi" type="hidden"/>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Eliminar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="paginador">
			<ul class="pagination">
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li class="page-item"><a class="page-link" href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected page-item page-link">'.$i.'</li>';
					}else{
						echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li class="page-item"><a class="page-link" href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <script src="bootstrap/js/validaciones.js" type="text/javascript"></script>
        <script src="bootstrap/js/funcion.js" type="text/javascript"></script>
    
        <!--- datatable javascript-->
        <br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
        <!--<script src="datatables/datatables.min.js" type="text/javascript"></script>-->
        <script src="bootstrap/js/main.js" type="text/javascript"></script>

        
    </body>
        </html>