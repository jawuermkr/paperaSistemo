<?php

    $host = "localhost";
    $basedatos = "ps";
    $usuario = "root";
    $clave = "Asiste.2021";

    // lista de tablas con su variable

    $tablausuarios = "usuarios";
    $tablacategorias = "categorias";
    $tablaproductos = "productos";
    $tablafacturas = "facturas";
    $tabladetafacturas = "detalle_facturas";

    error_reporting(1);

    $conexion = new mysqli($host,$usuario,$clave,$basedatos);

    if ($conexion->connect_errno) {
        echo "No se pudo hacer conexión con la base de datos";
        exit();
    }
?>