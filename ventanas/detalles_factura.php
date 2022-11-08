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
                <form method="POST" action="detalles_factura.php">
                    <div class="form-group">
                    Código de Factura <input class="form-control" type="text" name="cod_f"><br/>
                    Código de Producto <input class="form-control" type="text" name="cod_p"><br/>
                    Cantidad <input class="form-control" type="text" name="cantidad"><br/>
                    <input class="btn btn-block btn-outline-success" name="btna" type="submit" value="Agregar">
                    <input class="btn btn-block btn-outline-warning" name="btnq" type="submit" value="Quitar Producto">
                    <input class="btn btn-block btn-outline-primary" name="btnt" type="submit" value="Total">
                    <input class="btn btn-block btn-outline-success" name="btnv" type="submit" value="Ver Factura">
                        
                    </div>
                </form>
            </div>
            <div class="col-md-4">                
                <?php
                // TABLA PRODUCTOS
            echo "<p> Listado de Productos </p>";
            include("../abrir_conexion.php");

               $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos");
               while($consulta = mysqli_fetch_array($resultados)){

                echo 
                    "
                      <table class=\"table table-striped table-responsive\" width=\"100%\">
                        <tr>
                          <td><b><center>Código de Producto</center></b></td>
                          <td><b><center>Nombre</center></b></td>
                          <td><b><center>Precio</center></b></td>
                        </tr>
                        <tr>
                          <td>".$consulta['cod_p']."</td>
                          <td>".$consulta['nombre']."</td>
                          <td>".$consulta['costo_u']."</td>
                        </tr>
                      </table>
                    ";            
                }

                include("../cerrar_conexion.php");
                ?>

            </div>
            <div class="col-md-4">
                <?php
                //INSERTAR
                if (isset($_POST['btna'])){
                    
                    $codf = $_POST['cod_f'];
                    $codp = $_POST['cod_p'];
                    $cant = $_POST['cantidad'];
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos WHERE cod_p = '$codp'");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $menos = $consulta['existencias'] - $cant;
                    }
                    
                        $_UPDATE_SQL="UPDATE $tablaproductos Set
                            existencias='$menos'

                            WHERE cod_p ='$codp'";

                            mysqli_query($conexion,$_UPDATE_SQL);
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos WHERE cod_p = '$codp'");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $pre = $consulta['costo_u'];
                        $multi = $cant * $pre;
                    }
                    
                    if($codf=="" || $codp=="" || $cant==""){
                        echo "Los campos son obligatorios";
                        include("../cerrar_conexion.php");
                    } else {
                                        
                    $conexion->query("INSERT INTO $tabladetafacturas (cod_f,cod_p,cantidad,precio) values('$codf','$codp','$cant','$multi')"); 
                        
                    include("../cerrar_conexion.php");
                    echo "Agregado al carrito. <br/>";
                    echo "Se actualizaron las existencias, quedan <b>" . $menos . "</b> unidades del producto.";
                    echo "<hr>";
                    }
                }
                
                // RECARGAR FACTURA
                echo "<p>Detalles de Factura</p>";
                    
                    $codf = $_POST['cod_f'];
                    
                    if($codf==""){
                        echo "Ingrese el código de factura";
                    } else {
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tabladetafacturas WHERE cod_f = '$codf'");
                    while($consulta = mysqli_fetch_array($resultados)){
                        
                    echo "<table class=\"table table-striped table-responsive\" width=\"100%\">
                            <tr>
                              <td><b><center>Código de Factura</center></b></td>
                              <td><b><center>Código de Producto</center></b></td>
                              <td><b><center>Cantidad</center></b></td>
                              <td><b><center>Precio</center></b></td>
                            </tr>
                            <tr>
                              <td>".$consulta['cod_f']."</td>
                              <td>".$consulta['cod_p']."</td>
                              <td>".$consulta['cantidad']."</td>
                              <td>".$consulta['precio']."</td>
                            </tr>
                          </table>";
                    }
                    
                    include("../cerrar_conexion.php");
                    }
                
                
                //QUITAR PRODUCTO
                
                if(isset($_POST['btnq'])){
                    
                    $codf = $_POST['cod_f'];
                    $codp = $_POST['cod_p'];
                    $existe = 0;
                    
                    if($codp==""){
                        echo "Ingrese el código de producto y factura para eliminar";
                    } else {
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tabladetafacturas WHERE cod_f = '$codf' AND cod_p = '$codp'");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $regreso = $consulta['cantidad'];
                    }
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos WHERE cod_p = '$codp'");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $stock = $consulta['existencias'];
                    }
                        $act = $regreso + $stock;
                        
                    $_UPDATE_SQL="UPDATE $tablaproductos Set
                    existencias='$act'
                    WHERE cod_p ='$codp'";
                    mysqli_query($conexion,$_UPDATE_SQL);
                        
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tabladetafacturas");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $existe++;
                    }
                        if($existe==0){
                            echo "El producto no existe";
                        } else {
                            $_DELETE_SQL = "DELETE FROM $tabladetafacturas WHERE cod_p = '$codp' AND cod_f = '$codf'";
                            mysqli_query($conexion,$_DELETE_SQL);
                        }
                        echo "El producto se teriró de la factura indicada.";
                    }
                    include("../cerrar_conexion.php");
                }
                
                // TOTAL
                if(isset($_POST['btnt'])){
                    
                    $codf = $_POST['cod_f'];
                    
                    include("../abrir_conexion.php");

                        $resultados = mysqli_query($conexion,"SELECT * FROM $tabladetafacturas WHERE cod_f = '$codf'");
                        while($consulta = mysqli_fetch_array($resultados)){
                            $codfac = $consulta['cod_f'];
                            $suma += $consulta['precio'];
                        }
                        
                        $_UPDATE_SQL="UPDATE $tablafacturas Set
                        total='$suma',
                        estado_f='Ok'

                        WHERE cod_f ='$codf'";

                        mysqli_query($conexion,$_UPDATE_SQL);
                    
                        echo "<hr>";
                        echo "<p class=\"alert-success\"> Total a Pagar $" . $suma . "</p>";
                        include("../cerrar_conexion.php");
                        
                        echo "<form method=\"POST\" action=\"../pdf/imprimir.php\">";
                        echo "<input class=\"form-control\" type=\"text\" name=\"fact\" value=\"" . $codfac . "\" >";
                        echo "<input name=\"imp_pdf\" class=\"btn btn-block btn-outline-success\" type=\"submit\" href=\"../pdf/imprimir.php\" target=\"_blank\" value=\"Imprimir\">";
                        echo "</form>";
                }
                ?>
            </div>
        </div>
    </div>
    
<?php
    include("footer.php");
?>