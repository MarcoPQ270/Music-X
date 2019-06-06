<?php
     include_once("./Utilerias/BaseDatos.php");
     $post = $_POST; // Recibe los parametros
      
     if  (!isset($_SESSION))
        session_start();
     $idSess = session_id(); // Obtenemos el numero de session
     $res = validaUsr($post,$idSess);
     if ($res == "1"){
            $_SESSION["tu"]=$res;
            $_SESSION["email"]=$post['correo'];
            $_SESSION["ids"]=$idSess;
            $response['status']= true;
                  $response['data']="http://localhost/pruebas/entradas/contentrada.php";
      }
      else{
      if($res == "52"){
            $_SESSION["tu"]=$res;
            $_SESSION["email"]=$post['correo'];
            $_SESSION["ids"]=$idSess;
            $response['status']= true;
                  $response['data']="http://localhost/pruebas/webmaster.php";     
      }else{
            $response['status']= false;
            $response['data']=$post;
      }

      }     
      echo json_encode($response);
?>