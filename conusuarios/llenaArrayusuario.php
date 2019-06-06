<?php
    include_once("../Utilerias/BaseDatos.php");
    
    $cur = cargausuario();
    $data=array();
    $response=array();
    $response['status']=1;
    $response['data']=array();
    foreach ($cur as $tupla)
    {
        $data[$tupla['idusuario']]=$tupla;
    }
    $response['data']=$data;
    echo json_encode($response);
?>