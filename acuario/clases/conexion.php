<?php
class Conexion extends mysqli{

    function __construct(){
        parent::__construct("localhost", "root", "", "ges_acuario3");
    }
}
?>