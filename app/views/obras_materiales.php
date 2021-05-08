<?php
    $var = $_GET["id"];
    include "prueba.php";
?>

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
        <section>
            <div id="obras">
                
            </div>
        </section>
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
</html>     