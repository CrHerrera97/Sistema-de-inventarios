<?php

require '../config/loader.php';

use App\controllers\ObrasController;

$nombre_obra = filter_input(INPUT_POST, "nombre_obra");
$fecha_inicio = filter_input(INPUT_POST, "fecha_inicio");
$fecha_final = filter_input(INPUT_POST, "fecha_final");
$estado = filter_input(INPUT_POST, "estado");
$materiales = filter_input(INPUT_POST, "materiales");
$herramientas = filter_input(INPUT_POST, "herramientas");
$empleados = filter_input(INPUT_POST, "empleados");

$objObraController = new ObrasController();
if ($objObraController->grabarObras($nombre_obra, $fecha_inicio, $fecha_final, $estado, $materiales, $herramientas,$empleados)) {
    header("location: obras_listar.php");
    exit();
}
//de lo contrario...
header("location: obras_listar.php?msg=2");
?>
