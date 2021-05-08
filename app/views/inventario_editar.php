<?php

require '../config/loader.php';

use App\controllers\InventarioController;

if (isset($_POST['update'])) {
    $codigo = filter_input(INPUT_POST, "codigo");
    $marca = filter_input(INPUT_POST, "marca");
    $referencia = filter_input(INPUT_POST, "referencia");
    $descripcion = filter_input(INPUT_POST, "descripcion");
    $codBarras = filter_input(INPUT_POST, "codigo_barras");
    $cantidad = filter_input(INPUT_POST, "cantidad");
    $precio = filter_input(INPUT_POST, "precio");
}

$objInventarioController = new InventarioController();
if ($objInventarioController->editarInventario($codigo, $marca, $referencia, $descripcion, $codBarras, $cantidad, $precio)) {
    header("location: index.php");
    exit();
}
//de lo contrario...
header("location: index.php");
?>
