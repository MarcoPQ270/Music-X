<body>
<style> 
    body{
        background:url("http://localhost/pruebas/img/font.jpg")
}</style>
<?php include_once("./Fo/header.php");
          include_once("./utilerias/BaseDatos.php");
          if  (!isset($_SESSION))
             session_start();
            $ids = session_id();
          ?>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
            <div class="card-image" align="center">
            <img src="http://localhost/pruebas/img/cov.jpg" width="200">
                        <span align="center" class="card-title">
                            <h3>Control de Acceso</h3>
                            </span>
               </div>    
                <div class="card-content">
                    <br>
                    <form id="frm-acceso" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="email" id="correo" name="correo" class="validate">
                                <label for="correo">Correo electronico:</label>
                            </div>
                            <div class="input-field col s12">
                            <i class="material-icons prefix">music_note</i>
                                <input type="password" id="contra" name="contra" class="validate">
                                <label for="contra">Contraseña:</label>
                            </div>
                            <div class="input-field col s12 offset-m5">
                                <a id="un_lock" class="btn-floating btn-large waves-effect waves-light pink" >
                                    <i class="material-icons">lock_open</i>
                                </a>
                                <a id="add_record" class="btn-floating btn-large waves-effect waves-light pink" >
                                    <i class="material-icons">person_add</i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     
    </div>
   <!-- Ventana Modal -->
   <div class="modal" id="modalRegistro">
       <div class="modal-content">
           <h4>Registro de Usuarios</h4>
           <br>
           <form id="frm-registro" method="post">
              <div class="row">
                    <div class="input-field col s12">
                       <input type="email" id="corr" name="corr" class="validate">
                       <label for="corr">Correo:</label>
                   </div>
                   <div class="input-field col s12">
                      <input type="text" id="nom" name="nom" class="validate">
                      <label for="nom">Nombre Completo:</label>
                </div>
                <div class="input-field col s12">
                      <input type="password" id="pwd" name="pwd" class="validate">
                      <label for="pwd">Contraseña:</label>
                </div>
             </div>
           </form>
       </div>
       <div class="modal-footer">
           <a id="guardar" class="modal-action waves-effect waves-green btn-flat" >Guardar Registro</a>
       </div>
   </div>
   <?php include_once("./Fo/footer.php"); ?>
    <script type="text/javascript" src="./js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script type="text/javascript" src="./js/materialize.js"></script>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.min.js"></script>     
    <script type="text/javascript" src="./resources/js/Inicio.js"></script>
    
</body>
</html>