<?php

function cargaAutomaticaClases($nameSpace) {
    $rutaConfig = "app/config";
    $rutaActual = str_replace("\\", "/", __DIR__);
    $rutaProyecto = str_replace($rutaConfig, "", $rutaActual);

    $nombreClase = strtolower($nameSpace);
    $rutaClase = str_replace("\\", "/", $nombreClase);
    $claseCargar = $rutaProyecto . "/" . $rutaClase . ".php";
    require $claseCargar;
}

spl_autoload_register("cargaAutomaticaClases");
