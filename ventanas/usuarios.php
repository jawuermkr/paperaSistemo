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
                <form method="POST" action="usuarios.php">
                    <div class="form-group">
                    Identificación <input class="form-control" type="text" name="identi"><br/>
                    Nombre <input class="form-control" type="text" name="nombre"><br/>
                    Cargo <input class="form-control" type="text" name="cargo"><br/>
                    Teléfono <input class="form-control" type="text" name="telefono"><br/>
                    Correo <input class="form-control" type="text" name="correo"><br/>
                    Clave <input class="form-control" type="text" name="clave"><br/>
                    <input class="btn btn-block btn-outline-success" name="btnuser" type="submit" value="Insertar">
                    <input class="btn btn-block btn-outline-primary" name="btncons" type="submit" value="Consultar">
                    <input class="btn btn-block btn-outline-warning" name="btnact" type="submit" value="Actualizar">
                    <input class="btn btn-block btn-outline-danger" name="btneli" type="submit" value="Eliminar">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                
                <?php
                
                // INSERTAR
                
                if (isset($_POST['btnuser'])){
                    
                    $ide = $_POST['identi'];
                    $nom = $_POST['nombre'];
                    $car = $_POST['cargo'];
                    $tel = $_POST['telefono'];
                    $cor = $_POST['correo'];
                    $cla = $_POST['clave'];
                    
                    if($ide=="" || $nom=="" || $car=="" || $tel=="" || $cor=="" || $cla==""){
                        echo "Los campos son obligatorios";
                    } else {
                    
                    include("../abrir_conexion.php");

                    $conexion->query("INSERT INTO $tablausuarios (identificacion,nombre,cargo,telefono,correo,clave) values('$ide','$nom','$car','$tel','$cor','$cla')"); 
                    
                    include("../cerrar_conexion.php");
                    echo "Los datos se guardaron corectamente";
                    }
                }
                
                // CONSULTAR
                
                if(isset($_POST['btncons'])){
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablausuarios");
                    while($consulta = mysqli_fetch_array($resultados)){
                    
                    echo "<table class=\"table table-striped table-responsive\" width=\"100%\">
                            <tr>
                              <td><b><center>Identificación</center></b></td>
                              <td><b><center>Nombre</center></b></td>
                              <td><b><center>Cargo</center></b></td>
                              <td><b><center>Teléfono</center></b></td>
                              <td><b><center>Correo</center></b></td>
                            </tr>
                            <tr>
                              <td>".$consulta['identificacion']."</td>
                              <td>".$consulta['nombre']."</td>
                              <td>".$consulta['cargo']."</td>
                              <td>".$consulta['telefono']."</td>
                              <td>".$consulta['correo']."</td>
                            </tr>
                          </table>";            
                    }
                    
                    include("../cerrar_conexion.php");
                }
                
                // ACTUALIZAR
                
                if(isset($_POST['btnact'])){
                    
                    $ide = $_POST['identi'];
                    $nom = $_POST['nombre'];
                    $car = $_POST['cargo'];
                    $tel = $_POST['telefono'];
                    $cor = $_POST['correo'];
                    $cla = $_POST['clave'];
                    
                include("../abrir_conexion.php");
                    
                if($ide=="" || $nom=="" || $car=="" || $tel=="" || $cor=="" || $cla==""){
                    echo "Los campos son obligatorios";
                } else {
                    $_UPDATE_SQL="UPDATE $tablausuarios Set
                    identificacion='$ide',
                    nombre='$nom',
                    cargo='$car',
                    telefono='$tel',
                    correo='$cor',
                    clave='$cla'
                    
                    WHERE identificacion='$ide'";
                    
                    mysqli_query($conexion,$_UPDATE_SQL);
                    
                    echo "Datos actualizados correctamente";
                    
                    }

                    include("../cerrar_conexion.php");
                }
                
                //ELIMINAR
                if(isset($_POST['btneli'])){
                    
                    $ide = $_POST['identi'];
                    $existe = 0;
                    if($ide==""){
                        echo "Ingrese el núnero de identificación para eliminar";
                    } else {
                    
                    include("../abrir_conexion.php");
                    
                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablausuarios");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $existe++;
                    }
                        if($existe==0){
                            echo "El usuario no existe";
                        } else {
                            $_DELETE_SQL = "DELETE FROM $tablausuarios WHERE identificacion = '$ide'";
                            mysqli_query($conexion,$_DELETE_SQL);
                        }
                        echo "El usuario se eliminó correctamente ";
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