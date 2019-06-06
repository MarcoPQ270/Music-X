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
<?php include_once('./Fo/header.php'); ?>
<main><style> 
    body{
        background:url("http://localhost/pruebas/img/font.jpg")
}</style>
        <section >
            <div class="container">
                <div class="row">

                  
                <h3 align="center" style="color:#FFFAF0";>Catalogos</h3 >

                            <a href="http://localhost/pruebas/congenero/contgenero.php">
                            <img src="http://localhost/pruebas/img/font1.jpg" width="230" height="230"></a>

                            <a href="http://localhost/pruebas/concanciones/contcanciones.php">
                            <img src="http://localhost/pruebas/img/canciones.jpg" width="230" height="230"></a>
                            
                            <a href="http://localhost/pruebas/conusuarios/contusuario.php">
                            <img src="http://localhost/pruebas/img/usuarios.jpg" width="230" height="230"></a>

                            <a href="http://localhost/pruebas/concompositor/contcompos.php">
                            <img src="http://localhost/pruebas/img/compositores.jpg" width="230" height="230"></a>
                                <br>
                            <a href="http://localhost/pruebas/entradas/contentrada.php">
                            <img src="http://localhost/pruebas/img/Entrada.jpg" width="230" height="230"></a>

                    </div>
      
                  </div>
                     <!--Validaciones con JQuery-->
                    <script src="./js/jquery-3.0.0.min.js" type="text/javascript"></script>
                    <script src="./js/jquery.validate.min.js" type="text/javascript"></script>
                    <script src="./js/validaregistro.js" type="text/javascript"></script>
                    <script>  document.addEventListener('DOMContentLoaded', function() {
                                var elems = document.querySelectorAll('.slider');
                                var instances = M.Slider.init(elems, options);
                            });
                    </script>
                </div>
            </div>
        </section>
        <svg viewbox="0 0 100 25">
                        <path fill="#ec407a " opacity="0.5" d="M0 30 V15 Q30 3 60 15 V30z"/>
                        <path fill="#f06292"  d="M0 30 V12 Q30 17 55 12 T100 11 V30z"/>
                </svg>
<?php include('./Fo/footer.php');?>