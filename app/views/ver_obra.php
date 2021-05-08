<?php
require_once '../config/loader.php';
include 'paginador_obra.php';

use App\controllers\ObrasController;

//$codigo = filter_input(INPUT_GET, "codigo");

$objObrasController = new obrasController();
$registros = $objObrasController->getObras();

//la clave para poder sacar la variable está en el header, pasando la variable a paginador_Ver_obra
//luego de eso la idea es recuperar la variable y llevarla a ver_obra para que carguen los datos con la variable

$id = $_GET["id"];

header("location: paginador_ver_obra.php?id=$id");


//llamamos al objeto para recibir el codigo para actualizar
//$campos = $objInventarioController->getInventarioCodigo($codigo);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--- datatables --->
        
        <!--<link href="datatables/datatables.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>-->
        

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
                            <h5>Buscar:</h5><input type="text" id="txtnom" name="txtnom" value="" onkeyup="buscar_obras()" placeholder="Busqueda...">
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