<html>
<head>
    <title>Papera Sistemo | 1.0</title>
    <link rel="shortcut icon" type="img/x-icon" href="../img/favicon.ico"/>
    <link rel="shortcut icon" type="img/vnd.microsoft.ico" href="../img/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <meta charset="UTF-8">
</head>
<body>
    
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="dashboard.php">Papera Sistemo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              <a class="nav-link" href="facturas.php">Facturas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categorias.php"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>Categorías</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="usuarios.php">Usuarios</a>
            </li>
        </ul>
        <div class="row">
            <a class="mr-sm-2" href="perfil.php" name="activo"><img class="rounded float-right" src="../img/admin.png"/></a>
            <a class=" nav-link" href="cerrar_sesion.php"><span class="glyphicon glyphicon-off"></span> Salir</a>
        </div>
        </div>
    </nav>