<?php
$servidor = "localhost";
$basedeDatos="restaurante";
$usuario = "root";
$password="";
$port="3307";
try {
    $conexion = new PDO("mysql:host=$servidor;port=$port;dbname=$basedeDatos", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $conexion->exec("SET CHARACTER SET utf8");
    
} catch (Exception $error) {
    echo $error->getMessage();
}

?>