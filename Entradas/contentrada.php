<?php
if(!isset($_SESSION))
    session_start();
$tu=$_SESSION['tu'];
    if($tu == 52 || $tu==1){
        $_SESSION['tu'];
        $_SESSION['email'];
        $response['status'] = true;
    } else{
        header('location: http://localhost/pruebas');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music X</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/Music.ico" />
</head>
<body>
<style> 
    body{
        background:url("http://localhost/pruebas/img/font.jpg")
}</style>
<?php include_once("../Fo/header.php"); ?><br>
<span><h4 align='center' style="color:#FFFAF0"; >Ultimas Entradas</h4>
    <div class="row">    
                            <?php
                                include_once("../Entradas/CargaEntrada.php");
                            ?>
    
   <!-- Ventana Modal -->
   
   </div>
   <?php include_once("../Fo/header.php"); ?>
    <script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>  
    <script type="text/javascript" src="../js/new.js"></script>    
    <script type="text/javascript" src="../resources/js/Entrada.js"></script>
    <script type="text/javascript">
        
    </script> 


</body>
</html>