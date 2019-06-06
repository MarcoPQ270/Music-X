<?php
     include_once("./Utilerias/BaseDatos.php");
     if  (!isset($_SESSION))
     {
        session_start(); 
     }
     else
     {
        $idSess = session_id();
        $tu = $_SESSION["tu"];
        $correo = $_SESSION["email"];
        $idsess = "";
        validaSess($correo, $tu, $idsess);
        if ($idsess != $idSess && $tu != 52)
        {
            $_SESSION["tu"]=$tu;
            $_SESSION["email"]=$correo;
            $_SESSION["ids"]=$idSess;
            $response['status']= true;
            $response['data']="http://localhost/pruebas/concanciones/contcanciones.php";
        }
        else
        {
            $_SESSION["tu"]=$tu;
            $_SESSION["email"]=$correo;
            $_SESSION["ids"]=$idSess;
            $response['status']= true;
            $response['data']="http://localhost/pruebas/inicio/";
        }
     }        
?>