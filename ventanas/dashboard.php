<?php
    include("header.php");
?>
    
<?php
    session_start();
    ob_start();
    if(isset($_POST['btn_ini'])){
        $_SESSION['correcto']=0;
        $identi = $_POST['user'];
        $pass = $_POST['pass'];
        if($identi=="" || $pass==""){
            $_SESSION['correcto']=2;//2 sera error de campos vacios
        } else {
        include("../abrir_conexion.php");
        $_SESSION['correcto']=3;//2 seran datos incorrectos
        $resultados = mysqli_query($conexion,"SELECT * FROM $tablausuarios WHERE identificacion = '$identi' AND clave = '$pass'");
        while($consulta = mysqli_fetch_array($resultados)) {
                $_SESSION['correcto']=1;
            }
        include("../cerrar_conexion.php");
      }
    }
        
    if($_SESSION['correcto']<>1){
      header('Location:../index.php');
    }
  ?>

    <div class="container">
        
        <div class="jumbotron">
            <h1>Papera Sistemo</h1>
            <h2>Sistema de Ventas e Inventario</h2><hr>
            <p>Propietario de licencia: <b>Papelería y Miscelánea La Oportunidad</b></p>
        </div>
        <div class="col-md-12">
            <?php
            if(isset($_SESSION['correcto'])){
                
                if($_SESSION['correcto']==1){
                    include("../abrir_conexion.php");
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablausuarios WHERE identificacion = '$identi'");
                    while($consulta = mysqli_fetch_array($resultados)) {
                        echo "<hr>";
                        echo "<p align=\"center\">Que bueno tenerte de regreso <b>" . $consulta['nombre'] . ". </b> No hay novedades en nuestro panel, puedes continuar con normalidad. </p>";
                        echo "<hr>";
                    }
                    include("../cerrar_conexion.php");
                }
            }
            ?>
        </div>
        <div class="row">
            <?php
            include("../abrir_conexion.php");
                    
                $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos");
                while($consulta = mysqli_fetch_array($resultados)){
                    
                if($consulta['existencias']<10){
                    echo "<p class=\"alert-danger\"> Quedan menos de 10 unidades de los siguientes productos </p><br/>";
                    echo 
                        "
                          <table class=\"table table-striped table-responsive\" width=\"100%\">
                            <tr>
                              <td><b><center>Código de Categoría</center></b></td>
                              <td><b><center>Código del Producto</center></b></td>
                              <td><b><center>Nombre</center></b></td>
                              <td><b><center>Tamaño</center></b></td>
                              <td><b><center>Color</center></b></td>
                              <td><b><center>Costo por Unidad</center></b></td>
                              <td><b><center>Existencias</center></b></td>
                            </tr>
                            <tr>
                              <td>".$consulta['cod_c']."</td>
                              <td>".$consulta['cod_p']."</td>
                              <td>".$consulta['nombre']."</td>
                              <td>".$consulta['tamaño']."</td>
                              <td>".$consulta['color']."</td>
                              <td>".$consulta['costo_u']."</td>
                              <td>".$consulta['existencias']."</td>
                            </tr>
                          </table>
                        ";            
                    }
                }
                include("../cerrar_conexion.php");
            ?>
        </div>
        <div class="row">
            <div class="col-md-3 oo">
                <a href="facturas.php"><h2>Facturas</h2></a>
            </div>
            <div class="col-md-3 oo">
                <a href="categorias.php"><h2>Categorías</h2></a>
            </div>
            <div class="col-md-3 oo">
                <a href="productos.php"><h2>Productos</h2></a>
            </div>
            <div class="col-md-3 oo">
                <a href="usuarios.php"><h2>Usuarios</h2></a>
            </div>
        </div>
        
    </div>
    
<?php
    include("footer.php");
?>