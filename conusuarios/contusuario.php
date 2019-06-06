<?php
if(!isset($_SESSION))
    session_start();
$tu=$_SESSION['tu'];
    if($tu == 52){
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
    <title>Music X usuarios</title>
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
    <?php include_once("../Fo/header.php"); ?>
    <div class="row">
        <div class="col s12  ">
            <div class="card">
            <a id="print-record" class="btn-floating btn-large waves-effect waves-light right pink" >
                    <i class="material-icons">local_printshop</i>
                </a>
                <a id="print-record" class="btn-floating btn-large waves-effect waves-light right pink" href="http://localhost/pruebas/webmaster.php">
                    <i class="material-icons">arrow_back</i>
                </a>
                
                    <span><h3>Tabla de usuarios</h3></span>
                    <table id="cur" class="highlight bordered dataTable">
                        <thead>
                           <tr><th>Correo usuario</th><th>Nombre</th><th>Tipo de usuario</th><th>Operaciones</th></tr>
                                               </thead>
                        <tbody>
                            <?php
                                include_once("../conusuarios/CargaUsuarios.php");
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   <!-- Ventana Modal -->
   <div class="modal" id="modalRegistro">
       <div class="modal-content">
           <h4>Alta y Edición de Usuarios</h4>
           <br>
           <form id="frm-usuario" method="post" enctype="multipart/form-data" >
              <div class="row">
                   <div class="input-field col s12">
                       <input type="hidden" id="pk" name="pk" value="0">
                       <input type="text" id="corr" name="corr" class="validate">
                       <label for="corr">Correo usuario</label>
                   </div>
                   <div class="input-field col s12">
                       <input type="text" id="nom" name="nom" class="validate">
                       <label for="nom">Nombre de usuario</label>
                   </div>
                   <div class="input-field col s12">
                       <input type="text" id="tipus" name="tipus" class="validate">
                       <label for="tipus">tipo de usuario</label>
                   </div>
             </div>
           </form>
       </div>
       <div class="modal-footer">
           <a id="guardar" class="modal-action waves-effect waves-green btn-flat" >Guardar</a>
       </div>
   </div>
   <?php include_once("../Fo/footer.php"); ?>
    <script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>     
    <script type="text/javascript" src="../js/new.js"></script> 
    <script type="text/javascript" src="../resources/js/Usuarios.js"></script>
    <script type="text/javascript">
        
    </script> 


</body>
</html>