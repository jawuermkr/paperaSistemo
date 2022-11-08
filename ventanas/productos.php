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
                <form method="POST" action="productos.php">
                    <div class="form-group">
                    Categoría<br/>
                    <select class="form-control" name="cod_c">
                        <?php
                            include("../abrir_conexion.php");
                            $resultados = mysqli_query($conexion,"SELECT * FROM $tablacategorias");
                            while ($consulta=mysqli_fetch_array($resultados)){
                                $codcat = $consulta['cod_c'];
                                $detalle = $consulta['tipo'];
                        ?>
                            <option value="<?php echo $codcat ?>"><?php echo $detalle ?></option>
                                <?php
                            include("../cerrar_conexion.php");
                            }
                        ?>
                    </select><br/>
                    Código de Producto <input class="form-control" type="text" name="cod_p"><br/>
                    Nombre <input class="form-control" type="text" name="nombre"><br/>
                    Tamaño <input class="form-control" type="text" name="tamano"><br/>
                    Color <input class="form-control" type="text" name="color"><br/>
                    Costo Unidad <input class="form-control" type="text" name="costo_u"><br/>
                    Existencias <input class="form-control" type="text" name="existencias"><br/>
                    <input class="btn btn-block btn-outline-success" name="btni" type="submit" value="Insertar">
                    <input class="btn btn-block btn-outline-primary" name="btnc" type="submit" value="Consultar">
                    <input class="btn btn-block btn-outline-warning" name="btna" type="submit" value="Actualizar">
                    <input class="btn btn-block btn-outline-danger" name="btne" type="submit" value="Eliminar">

                    </div>
                </form>
            </div>
            <div class="col-md-8">
                
                <?php
                // INSERTAR
                if(isset($_POST['btni'])){
                    
                    $codc = $_POST['cod_c'];
                    $codp = $_POST['cod_p'];
                    $nom = $_POST['nombre'];
                    $tam = $_POST['tamano'];
                    $col = $_POST['color'];
                    $cosu = $_POST['costo_u'];
                    $exist = $_POST['existencias'];
                    
                    if($codc=="" || $codp=="" || $nom=="" || $tam=="" || $col=="" || $cosu=="" || $exist==""){
                        echo "Los campos son obligatorios";
                    } else {
                        
                    include("../abrir_conexion.php");
                    
                    $conexion->query("INSERT INTO $tablaproductos (cod_c,cod_p,nombre,tamanio,color,costo_u,existencias) values('$codc','$codp','$nom','$tam','$col','$cosu','$exist')"); 
                    
                    include("../cerrar_conexion.php"); 
                    
                    echo "Los datos se guardaron corectamente <br/><br/>";
                    }
                }

                //CONSULTAS PRODUCTOS
                if(isset($_POST['btnc'])){
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos");
                    while($consulta = mysqli_fetch_array($resultados)){
                    
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
                    
                    include("../cerrar_conexion.php");
                }
                // ACTUALIZAR
                
                if(isset($_POST['btna'])){
                    
                    $codc = $_POST['cod_c'];
                    $codp = $_POST['cod_p'];
                    $nom = $_POST['nombre'];
                    $tam = $_POST['tamano'];
                    $col = $_POST['color'];
                    $cosu = $_POST['costo_u'];
                    $exist = $_POST['existencias'];
                    
                include("../abrir_conexion.php");
                    
                if($codc=="" || $codp=="" || $nom=="" || $tam=="" || $col=="" || $cosu=="" || $exist==""){
                    echo "Los campos son obligatorios";
                } else {
                    $_UPDATE_SQL="UPDATE $tablaproductos Set
                    cod_c='$codc',
                    cod_p='$codp',
                    nombre='$nom',
                    tamanio='$tam',
                    color='$col',
                    costo_u='$cosu',
                    existencias='$exist'
                    
                    WHERE cod_p ='$codp'";
                    
                    mysqli_query($conexion,$_UPDATE_SQL);
                    
                    echo "Datos actualizados correctamente";
                    
                    }

                    include("../cerrar_conexion.php");
                }
                
                //ELIMINAR
                if(isset($_POST['btne'])){
                    
                    $codp = $_POST['cod_p'];
                    $existe = 0;
                    if($codp==""){
                        echo "Ingrese el código de producto a eliminar";
                    } else {
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablaproductos");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $existe++;
                    }
                        if($existe==0){
                            echo "El producto no existe";
                        } else {
                            $_DELETE_SQL = "DELETE FROM $tablaproductos WHERE cod_p = '$codp'";
                            mysqli_query($conexion,$_DELETE_SQL);
                        }
                        echo "El producto se eliminó correctamente ";
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