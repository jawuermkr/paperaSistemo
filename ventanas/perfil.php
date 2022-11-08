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
            <div class="col-md-8">
                
                <?php

	include("../abrir_conexion.php");
                    
		$resultados = mysqli_query($conexion,"SELECT * FROM $tablausuarios");
		while($consulta = mysqli_fetch_array($resultados)){
            $ide = $consulta['identificacion'];
			$nom = $consulta['nombre'];
			$car = $consulta['cargo'];
			$tel = $consulta['telefono'];
			$cor = $consulta['correo'];
			$cla = $consulta['clave'];
		}
		include("../cerrar_conexion.php");
		
		echo "<form method=\"POST\" action=\"perfil.php\">";
		echo "Identificación <input class=\"form-control\" type=\"text\" name=\"identi\" value=\"" . $ide . "\" ><br/>";
		echo "Nombre <input class=\"form-control\" type=\"text\" name=\"nombre\" value=\"" . $nom . "\" ><br/>";
		echo "Cargo <input class=\"form-control\" type=\"text\" name=\"cargo\" value=\"" . $car . "\" ><br/>";
		echo "Teléfono <input class=\"form-control\" type=\"text\" name=\"telefono\" value=\"" . $tel . "\" ><br/>";
		echo "Correo <input class=\"form-control\" type=\"text\" name=\"correo\" value=\"" . $cor . "\" ><br/>";
		echo "Clave <input class=\"form-control\" type=\"password\" name=\"clave\" value=\"" . $cla . "\" ><br/>";
		echo "<input name=\"btnap\" class=\"btn btn-block btn-outline-success\" type=\"submit\"  value=\"Actualizar\">";
		echo "</form>";
		
				
		if(isset($_POST['btnap'])){
			
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
			}	
			mysqli_query($conexion,$_UPDATE_SQL);
			include("../cerrar_conexion.php");
			
		}
?>
            </div>
            <div class="col-md-4">
                <div>
                    <img src="../img/admin.png" width="100%"/>
                    <input type="file">
                    <input class="btn btn-block btn-outline-success" type="submit" value="Cargar">
                </div>
                <?php
                // ACTUALIZAR
                
                if(isset($_POST['btna'])){
                    
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
                ?>

            </div>
        </div>
    </div>
    
<?php
    include("footer.php");
?>