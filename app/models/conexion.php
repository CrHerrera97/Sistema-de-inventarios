<?php

namespace App\Models;

require_once '../config/database.php';

use PDO;
use const App\Config\Database\CONFIG;

class Conexion {

    private $_servidor;
    private $_usuario;
    private $_clave;
    private $_nombreBase;
    protected $_conn;

    public function __construct() {
        $this->_servidor = CONFIG["DB_HOST"];
        $this->_nombreBase = CONFIG["DB_DATABASE"];
        $this->_usuario = CONFIG["DB_USERNAME"];
        $this->_clave = CONFIG["DB_PASSWORD"];
        
        $this->conectar();
    }
    
    public function conectar(){
        $codificacion = "SET NAMES \"UTF8\"";
        $cadena = "mysql::host={$this->_servidor};dbname={$this->_nombreBase}";
        $arreglo = array(PDO::MYSQL_ATTR_INIT_COMMAND => $codificacion);
        $this->_conn = new PDO($cadena, $this->_usuario, $this->_clave, $arreglo) ;
    }

}
