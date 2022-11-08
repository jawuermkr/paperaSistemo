<?php
    include("header.php");
?>
    
<?php
    session_start();
    ob_start();

    if($_SESSION['correcto']<>1){
      header('Location:../index.php');
    }
?>

    <div class="container">
        
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="facturas.php">
                    <div class="form-group">
                    Código de Factura <input class="form-control" type="text" name="cod_f"><br/>
                    Fecha <input class="form-control" type="date" name="fecha"/><br/>
                    Hora <input class="form-control" type="time" name="hora"><br/>
                    <input class="btn btn-block btn-outline-warning" name="btnc" type="submit" value="Crear Factura">
                    <p type="button" class="btn btn-block btn-outline-success"><a href="detalles_factura.php"> Detalles </a></p>
                    <input class="btn btn-block btn-outline-danger" name="btne" type="submit" value="Eliminar Factura">
                    <input class="btn btn-block btn-outline-primary" name="btnco" type="submit" value="Consultar Facturas">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                
                <?php
                // CREAR FACTURA
                if (isset($_POST['btnc'])){
    
                    $cod_f = $_POST['cod_f'];
                    $fecha = $_POST['fecha'];
                    $hora = $_POST['hora'];
                    
                    if($cod_f=="" || $fecha=="" || $hora==""){
                        echo "Los campos son obligatorios";
                    } else {
                    include("../abrir_conexion.php");

                    $conexion->query("INSERT INTO $tablafacturas (cod_f,fecha,hora) values('$cod_f','$fecha','$hora')"); 
                    
                    include("../cerrar_conexion.php");
                    echo "<p><b>!Perfecto!</b> Agregue los productos con el código de factura creado</p>";
                    }
                }
                // CONSULTAR FACTURAS
                
                if(isset($_POST['btnco'])){
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablafacturas");
                    while($consulta = mysqli_fetch_array($resultados)){
                    
                    echo 
                        "
                          <table class=\"table table-striped table-responsive\" width=\"100%\">
                            <tr>
                              <td><b><center>Código de Factura</center></b></td>
                              <td><b><center>Fecha</center></b></td>
                              <td><b><center>Hora</center></b></td>
                              <td><b><center>Total</center></b></td>
                              <td><b><center>Estado</center></b></td>
                            </tr>
                            <tr>
                              <td>".$consulta['cod_f']."</td>
                              <td>".$consulta['fecha']."</td>
                              <td>".$consulta['hora']."</td>
                              <td>".$consulta['total']."</td>
                              <td>".$consulta['estado_f']."</td>
                            </tr>
                          </table>
                        ";            
                    }
                    
                    include("../cerrar_conexion.php");
                }
                // ELIMINAR FACTURA
                
                if(isset($_POST['btne'])){
                    
                    $codf = $_POST['cod_f'];
                    $existe = 0;
                    if($codf==""){
                        echo "Ingrese el código de factura para eliminar";
                    } else {
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablafacturas");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $existe++;
                    }
                        if($existe==0){
                            echo "La factura no existe";
                        } else {
                            $_DELETE_SQL = "DELETE FROM $tablafacturas WHERE cod_f = '$codf'";
                            mysqli_query($conexion,$_DELETE_SQL);
                        }
                        echo "La factura se teriró de la lista.";
                    include("../cerrar_conexion.php");
                    }
                }
                ?>

            </div>
        </div>
    </div>
    
<?php
    include("footer.php");
?>