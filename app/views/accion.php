<?php
//include '../models/conexion.php';
$conection = new mysqli("localhost", "root", "", "pruebaa");
if (isset($_POST['query'])) {

    $respuesta = mysqli_real_escape_string($conection, $_POST['query']);
    $data = array();
    $sql = "SELECT * from inventario WHERE descripcion LIKE '%" . $respuesta . "%'";
    $res = $conection->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $data[] = $row["descripcion"];
        }
        echo json_encode($data);
    }

}