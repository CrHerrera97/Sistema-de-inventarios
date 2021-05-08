<?php

require '../config/loader.php';

use App\controllers\InventarioController;

$marca = filter_input(INPUT_POST, "marca");
$referencia = filter_input(INPUT_POST, "referencia");
$descripcion = filter_input(INPUT_POST, "descripcion");
$codBarras = filter_input(INPUT_POST, "codigo_barras");
$cantidad = filter_input(INPUT_POST, "cantidad");
$precio = filter_input(INPUT_POST, "precio");


$objInventarioController = new InventarioController();
if ($objInventarioController->grabarInventario($marca, $referencia, $descripcion, $codBarras, $cantidad, $precio)) {
    header("location: index.php");
    exit();
}
//de lo contrario...
//header("location: index.php?msg=2");
?>
