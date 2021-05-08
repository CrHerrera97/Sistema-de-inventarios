<?php

//aqui tambien puede ir el if del $_server
            
require_once '../config/loader.php';

//de momento no se va a incluir
//include 'paginador_obra.php';

use App\controllers\ObrasController;

//$codigo = filter_input(INPUT_GET, "codigo");

$objObrasController = new obrasController();
$registros = $objObrasController->getObras();   

$id = $_GET["id"];

$prueba = $objObrasController->nombre_obra($id);


$conection = new mysqli("localhost", "root", "", "pruebaa");
$sql_registe = mysqli_query($conection,"SELECT * FROM inventario");
$array = array();
if($sql_registe){
    while($row = mysqli_fetch_array($sql_registe)){
        $consulta = utf8_encode($row['descripcion']);
        array_push($array,$consulta);
    }
}


//llamamos al objeto para recibir el codigo para actualizar
//$campos = $objInventarioController->getInventarioCodigo($codigo);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <script src="bootstrap/js/jquery.min.js" type="text/javascript"></script>
        <link href="bootstrap/js/jquery-ui.css" rel=stylesheet type="text/css">
        <script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
        
        <link href="bootstrap/css/estilos.css" rel=stylesheet type="text/css">
        
        
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--<script src="bootstrap/js/jquery-3.3.1.js" type="text/javascript"></script>-->
    
        <script src="bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--- datatables --->
        
        <!--<link href="datatables/datatables.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>-->
        

    </head>
    <body class="container">
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

        <?php 
        
        //aqui estas lineas van a quedar comentadas para que se arregle el error de poder llamar al nombre de la obra
        //echo "<h3>Nombre de la obra:$prueba<h3>";

        foreach($prueba as $fil){
            echo "<h3 class='container'>"."Obra:".$fil['nombre_obra'];"</h3>";
        }
        $id = $_GET["id"];

        echo "<a class='button btn btn-success' href='obras_materiales.php?id=$id'>Ver</a>";
        ?>


        <!--<a class="button btn btn-success" href="ver_obra.php?id=".$data['codigo'].">Ver</a>-->
        <!--<a class="button btn btn-success" href="ver_obra.php?id="<?php $fil['nombre_obra']?>>Ver</a>-->
        
        <br><br>

        <!-- aqui van a quedar las pantallas --->
        <div class="container">
            <!-- aqui van a estar los materiales y las herramientas-->
            <div class="row">
                <div class="col xs-7">
                    <div class="row">
                        <h4>Agregar material</h4>
                        <button type="button" class="add" id="adicional" name="adicional"><img src="images/verde3.png" alt="x" width="25px" height="25px"/></button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <h4>Solicita:</h4>
                        <select name="empleados" class="form-control" style="width : 150px">

                        <?php
                            $conection = new mysqli("localhost", "root", "", "pruebaa");
                            $getEmpleados = mysqli_query($conection,"SELECT * FROM empleados");

                            $codigo = array();

                            while($row = mysqli_fetch_array($getEmpleados)){
                                $codigo[] = $row["codigo"];
                                $nombre = $row["nombre"];
                                $apellidos = $row["apellidos"];
                                //$herramientas_codigo = $row["herramientas_codigo"];
                                //$obras_codigo = $row["obras_codigo"];
                                ?>
                            
                            <option value="<?php echo $codigo[0]; ?>"><?php echo $nombre." ".$apellidos;?></option>
                            <?php
                        }

                        ?>
                        </select>
                        <!--<button type="button" class="eliminar"><img src="images/menos.png" alt="x" width="25px" height="25px"/></button>-->
                    </div>
                    <br>
                    <script>

                        //funcion para agregar y eliminar un material en obra
                        $(function(){
                            $("#adicional").on("click",function(){
                                $("#tabla tbody tr:eq(0)").clone().removeClass('fila').appendTo("#tabla");
                            });

                            //ahora la funcion que me permite eliminar
                            $(document).on("click",".eliminar",function(){
                                var parent = $(this).parents().get(0);
                                $(parent).remove();
                            });

                            $("#adicional2").on("click",function(){
                                $("#tabla2 tbody tr:eq(0)").clone().removeClass('fila').appendTo("#tabla2");
                            });
                            
                        });

                    </script>
                    <div>
                        <!-- formulario para que me haga la insercion multiple-->
                        
                        <form method="POST">
                        <table id="tabla">
                            <tr class="fila">
                            <td><input name="empleado_cod[]" type="hidden" value="<?php echo $codigo[0]?>"autocomplete="off" style="width : 50px"/></td>
                            <td>Cod:<input name="cod_barras[]"type="text" style="width : 70px"autocomplete="off"/></td>
                            <td>Descripcion:<input id="tag" name="inventario_cod[]" type="text"autocomplete="off" style="width : 120px"/></td>
                            <td>Cantidad:<input name="cantidad[]" type="text" autocomplete="off" style="width : 30px"/></td>
                            <td><input name="obras_cod[]" type="hidden"autocomplete="off" style="width : 30px" value="<?php echo $id?>"/></td>
                            <td class="eliminar"><img src="images/rojo.png" alt="x" width="25px" height="25px"/>
                            </tr>
                        </table>
                        <br>
                        <input class="button btn btn-primary" type="submit" name="insertar" value="Agregar">
                        </form>
                    </div>
                    <!--script de autocompleatado--->

                    <script type="text/javascript">
                    $(document).ready(function(){
                        //alert ("hola");
                        var items = <?= json_encode($array);?>
                        
                        $("#tag").autocomplete({
                            source:items
                        });
                    });
                    
                    </script>



                    <script>
                    $(document).ready(function () {
                        $("#articulo").typeahead({
                        source: function (query, resultado) {
                        $.ajax({
                        url: "accion.php",
                        type: "POST",
                        dataType: "json",
                        data: {query: query},
                        success: function (data) {
                        resultado($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
    });
</script>
                    
                    <?php 
                    if(isset($_POST['insertar'])){

                        $items1 = ($_POST['empleado_cod']);
                        $items2 = ($_POST['cod_barras']);
                        $items3 = ($_POST['inventario_cod']);
                        $items4 = ($_POST['cantidad']);
                        $items5 = ($_POST['obras_cod']);

                        /*
                        //generamos la consulta de la descripcion para así extraer el codigo de la descripcion
                        $sql_registe = mysqli_query($conection,"SELECT codigo FROM inventario WHERE descripcion = 'Cpu core i3'");
			            $result_register = mysqli_fetch_array($sql_registe);
			            $total_registro = $result_register['codigo'];

                        echo $total_registro;
                        echo "<br>";
                        print_r($items3);
                        echo "<br><br>";
                        var_dump($items3);

                        echo implode($items3);

*/
                        while(true){
                            $item1 = current($items1);
                            $item2 = current($items2);
                            $item3 = current($items3);
                            $item4 = current($items4);
                            $item5 = current($items5);

                            //los asignamos a las variables
                            $empleado_cod = (($item1 !== false)?$item1: ", &nbsp;");
                            $cod_barras = (($item2 !== false)?$item2: ", &nbsp;");
                            $inventario_cod = (($item3 !== false)?$item3: ", &nbsp;");
                            $cantidad = (($item4 !== false)?$item4: ", &nbsp;");
                            $obras_cod = (($item5 !== false)?$item5: ", &nbsp;");

                            //concatenamos los valores
                            $valores='("'.$empleado_cod.'","'.$cod_barras.'","'.$inventario_cod.'","'.$cantidad.'","'.$obras_cod.'"),';

                            $valoresQ = substr($valores,0,-1);

                            $conection = new mysqli("localhost", "root", "", "pruebaa");

                            $materiales="INSERT INTO materiales(empleado_cod,cod_barras,inventario_cod,cantidad,obras_cod)VALUES $valoresQ";
                            $result= mysqli_query($conection,$materiales);
                            $item1 = next($items1);
                            $item2 = next($items2);
                            $item3 = next($items3);
                            $item4 = next($items4);
                            $item5 = next($items5);

                            if ($item1 ===false && $item2 === false && $item3 ===false && $item4 ===false && $item5 ===false)break;
                        }
                    }
                    
                    ?>
                </div>
                <div class="col xs-5">

                    <div class="row">
                        <h4>Agregar herramienta</h4>
                        <button type="submit" class="add" id="adicional2" name="adicional2"><img src="images/verde3.png" alt="x" width="25px" height="25px"/></button>
                        <!--<button type="submit"><img src="images/menos.png" alt="x" width="25px" height="25px"/></button>-->
                    </div>
                    <br>
                    <div>
                        <form method="post">
                        <table id="tabla2">
                            <tr class="fila2">
                            <td>Solicita:<input type="text" style="width : 50px"/></td>
                            <td>Descripcion:<input type="text" style="width : 120px"/></td>
                            <td>Cantidad:<input type="text" style="width : 30px"/></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>

            </div>

            <br><br>

            <!-- aqui van a estar la devolucion y los empleados-->
            <div class="row">
                <div class="col xs-7">
                <div class="row">
                        <h4>Devolucion material</h4>
                        <button type="submit" class="add"><img src="images/verde3.png" alt="x" width="25px" height="25px"/></button>
                        <!---<button type="submit"><img src="images/menos.png" alt="x" width="25px" height="25px"/></button>-->
                    </div>
                    <br>
                    <div>
                        <form method="post">
                        <table id="tabla3">
                        <tr class="fila3">
                        <td>Devuelve:<input type="text" style="width : 20px" autocomplete="off"/></td>
                        <td>Cod:<input type="text" style="width : 70px" autocomplete="off"/></td>
                        <td>Descripcion:<input type="text" style="width : 120px" autocomplete="off"/></td>
                        <td>Cantidad:<input type="text" style="width : 30px" autocomplete="off"/></td>
                        </tr>
                        </table>
                        </form>
                    </div>
                </div>

                <div class="col xs-4">
                <div class="row">
                        <h4>Agregar empleado a la obra</h4>
                        <button type="submit" class="add"><img src="images/verde3.png" alt="x" width="25px" height="25px"/></button>
                        <!--<button type="submit"><img src="images/menos.png" alt="x" width="25px" height="25px"/></button>-->
                    </div>
                    <br>
                    <div>
                        <form method="post">
                            <table id="tabla4">
                                <tr>
                        <td>Nombre:<input type="text" style="width : 50px"/></td>
                        <td>Descripcion:<input type="text" style="width : 120px"/></td>
                        <td>Cantidad:<input type="text" style="width : 30px"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                </div>
            </div>

        </div>

        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
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