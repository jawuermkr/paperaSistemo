<html>
<head>
    <title>Login</title>
    <link rel="shortcut icon" type="img/x-icon" href="img/favicon.ico"/>
    <link rel="shortcut icon" type="img/vnd.microsoft.ico" href="img/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
</head>
    
<body>
<header class="bg-dark">
    <nav>
        <h1 class="nav">Papera Sistemo</h1>
        <p class="navbar">Sistema de Ventas e Inventario</p>
    </nav>
</header>

    
<div class="container">
    
    <div class="wrapper">
        <form method="post" action="ventanas/dashboard.php" class="form-signin">    
            <center><img class="logo" src="img/logo.png" /></center>
            
        <p class="bg-danger" align="center"><b>
            <?php
            session_start();
            ob_start();
            
            if(isset($_SESSION['correcto'])){
                                
                if($_SESSION['correcto']==2){
                    echo "Los campos son obligatorios";
                }
                if($_SESSION['correcto']==3){
                    echo "Datos incorrectos";
                }
            } else {
                $_SESSION['correcto']=0;
            }
            ?>
        </b></p>
        <p class="alert-success" align="center"><b>
            <?php
            if($_SESSION['correcto']==4){
                    echo "Gracias por tu visita";
                }
            ?>
        </b></p>
            
            <input type="text" class="form-control" name="user" placeholder="Usuario" autofocus="" />
            <input type="password" class="form-control" name="pass" placeholder="Contraseña" />      
            <input class="btn btn-lg btn-primary btn-block" name="btn_ini" type="submit" value="Ingresar">
        </form>
    </div>
        
</div>
        <footer class="footer">
            <p> &copy 2017 | Papera Sistemo | Versión 1.0 </p>
            <p><a href="http://verdaluno.com" target="_blank"> Desarrollado por Verda Luno </a></p>
        </footer>
    
</body>
</html>