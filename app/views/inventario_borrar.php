<?php 
require_once '../config/loader.php';

$codigo = filter_input(INPUT_POST, "codi");

use App\controllers\InventarioController;

$objInventarioController = new InventarioController();
if ($objInventarioController->borrarInventario($codigo)){
    header("location: index.php");
    exit();
} else {
    echo 'error';
}
//header("location: sedes_administrar.php?msg=2");


