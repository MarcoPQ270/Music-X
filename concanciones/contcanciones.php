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
    <title>Music X Canciones</title>
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
        <div class="col s12 m">
            <div class="card">
                <a id="add-record" class="btn-floating btn-large waves-effect waves-light right  pink" >
                    <i class="material-icons">add</i>
                </a>
                <a id="print-record" class="btn-floating btn-large waves-effect waves-light right pink" >
                    <i class="material-icons">local_printshop</i>
                </a>
                <a id="print-record" class="btn-floating btn-large waves-effect waves-light right pink" href="http://localhost/pruebas/webmaster.php">
                    <i class="material-icons">arrow_back</i>
                </a>
                
                <div class="card-content">
                    <span><h3>Biblioteca Musical</h3></span>
                    <table id="cur" class="highlight bordered dataTable">
                        <thead>
                           <tr><th>Nombre de la cancion</th><th>Fecha de publicacion</th><th>Genero</th><th>Artista</th><th>Caratula</th><th>Archivo mp3</th><th>Operaciones</th></tr>
                        </thead>
                        <tbody>
                            <?php
                                include_once("../concanciones/CargaCanciones.php");
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
           <h4>Alta y Edición de Canciones</h4>
           <br>
           <form id="frm-canciones" method="post" enctype="multipart/form-data" >
              <div class="row">
                   <div class="input-field col s12">
                       <input type="hidden" id="pk" name="pk" value="0">
                       <input type="text" id="nomcancion" name="nomcancion" class="validate">
                       <label for="">Nombre de la cancion</label>
                   </div>
                   <div class="input-field col s12">
                        <label for="fechapub">Fecha de publicacion</label>
                        <input type="text" id="Fechapub" name="fechapub" class="datepicker">                   
                   </div>
                   <div class="input-field col s12">
                      <select name="idtipgenero" id="idtipgenero" class="browser-default">
                      <?php
                                include_once("cargaselect.php");
                      ?>
                      </select>
                </div>
                <div class="input-field col s12">
                      <select name="idtipcom" id="idtipcom" class="browser-default">
                      <?php
                                include_once("cargaselectcom.php");
                      ?>
                      </select>
                </div>
                <div class="input-field col s12">
                     <div class="file-field input-field">
                        <div class="btn">
                            <span>Subir Caratula</span>
                            <input type="file" id="arch" name="arch">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate">
                            <input type="hidden" id="imagen" name="imagen">
                        </div>
                         
                    </div>
                    <div class="input-field col s12">
                     <div class="file-field input-field">
                        <div class="btn">
                            <span>Subir Archivo Musical</span>
                            <input type="file" id="can" name="can">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        </div>      
                    </div>
             </div>
           </form>
       </div>
       <div class="modal-footer">
           <a id="guardar" class="modal-action waves-effect waves-green btn-flat" >Guardar</a>
       </div>
   </div>
   <?php include_once("../Fo/header.php"); ?>
    <script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>  
    <script type="text/javascript" src="../js/new.js"></script>    
    <script type="text/javascript" src="../resources/js/canciones.js"></script>
    <script type="text/javascript">
        
    </script> 


</body>
</html>