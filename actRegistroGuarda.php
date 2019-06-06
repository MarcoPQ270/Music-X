<?php
     include_once("./Utilerias/BaseDatos.php");
     $post = $_POST; // 
      
     if  (!isset($_SESSION))
        session_start();
     $idSess = session_id();
     if (registraUsr($post,$idSess)){
            $response['status']= true;
            $response['data']=$post;
            }
      else{
            $response['status']= false;
            $response['data']=$post;
      }
      echo json_encode($response);
?>