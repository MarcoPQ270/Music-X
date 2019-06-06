<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="css/default.css">
    <title>Music X</title>
    <link rel="icon" type="image/x-icon" href="./fonts/Music.ico" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header>
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/materialize.min.css" media="screen,projection" type="text/css">

        <div class="navbar-fixed">
        <nav class="nav-estended" >
            <div class="nav-wrapper pink">
                
                <a href="index.php" class="brand-logo">Music X </a> 
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                <?php
                if(count($_SESSION)==0){
                    echo '<li><a href="http://localhost/pruebas/inicio.php">Iniciar sesión</a></li>';
                }else{
                    echo '<li><a href="http://localhost/pruebas/cerrarsesion.php">Cerrar sesión</a></li>';
                }
                ?>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="http://localhost/pruebas/inicio.php">Iniciar sesión</a></li>
      
        </ul>
        </div>
    </header>
