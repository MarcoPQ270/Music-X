<?php
     include_once("../Utilerias/BaseDatos.php");
     $post = $_POST; // 
     if (borragenero($post)){
            $response['status']= true;
            $response['data']=$post;
            }
      else{
            $response['status']= false;
            $response['data']=$post;
      }
      echo json_encode($response);
?>