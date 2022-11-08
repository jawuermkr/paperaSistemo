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
                <form method="POST" action="categorias.php">
                    <div class="form-group">
                    Código de Categoría <input class="form-control" type="text" name="cod_c"><br/>
                    Detalles <input class="form-control" type="text" name="tipo"><br/>
                    <input class="btn btn-block btn-outline-success" name="btncat" type="submit" value="Insertar">
                    <input class="btn btn-block btn-outline-primary" name="btncons" type="submit" value="Consultar">
                    <input class="btn btn-block btn-outline-warning" name="btna" type="submit" value="Actualizar">
                    <input class="btn btn-block btn-outline-danger" name="btne" type="submit" value="Eliminar">

                    </div>
                </form>
            </div>
            <div class="col-md-8">

                <?php
                //INSERTAR
                if (isset($_POST['btncat'])){

                    $cod_c = $_POST['cod_c'];
                    $tipo = $_POST['tipo'];

                    if($cod_c=="" || $tipo==""){
                        echo "Los campos son obligatorios";
                    } else {

                    include("../abrir_conexion.php");

                    $conexion->query("INSERT INTO $tablacategorias (cod_c,tipo) values('$cod_c','$tipo')");

                    include("../cerrar_conexion.php");
                    echo "Los datos se guardaron corectamente";
                    }
                }
                //CONSULTAS
                if(isset($_POST['btncons'])){

                    include("../abrir_conexion.php");

                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablacategorias");
                    while($consulta = mysqli_fetch_array($resultados)){

                    echo
                        "
                          <table class=\"table table-striped table-responsive\" width=\"100%\">
                            <tr>
                              <td><b><center>Código de Categoría</center></b></td>
                              <td><b><center>Detalles</center></b></td>
                            </tr>
                            <tr>
                              <td>".$consulta['cod_c']."</td>
                              <td>".$consulta['tipo']."</td>
                            </tr>
                          </table>
                        ";
                    }

                    include("../cerrar_conexion.php");
                }
                // ACTUALIZAR

                if(isset($_POST['btna'])){

                    $codc = $_POST['cod_c'];
                    $tipo = $_POST['tipo'];

                include("../abrir_conexion.php");

                if($codc==""){
                    echo "Ingrese el código de la categoría a actualizar";
                } else {
                    $_UPDATE_SQL="UPDATE $tablacategorias Set
                    cod_c='$codc',
                    tipo='$tipo'

                    WHERE cod_c='$codc'";

                    mysqli_query($conexion,$_UPDATE_SQL);

                    echo "Datos actualizados correctamente";

                    }

                    include("../cerrar_conexion.php");
                }

                //ELIMINAR
                if(isset($_POST['btne'])){

                    $codc = $_POST['cod_c'];
                    $existe = 0;
                    if($codc==""){
                        echo "Ingrese el código de categoría para eliminar";
                    } else {

                    include("../abrir_conexion.php");

                    $resultados = mysqli_query($conexion,"SELECT * FROM $tablacategorias");
                    while($consulta = mysqli_fetch_array($resultados)){
                        $existe++;
                    }
                        if($existe==0){
                            echo "La categoría no existe";
                        } else {
                            $_DELETE_SQL = "DELETE FROM $tablacategorias WHERE cod_c = '$codc'";
                            mysqli_query($conexion,$_DELETE_SQL);
                        }
                        echo "La categoría se eliminó correctamente ";
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
