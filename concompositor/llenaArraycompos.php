<?php
    include_once("../Utilerias/BaseDatos.php");
    
    $cur = cargacomp();
    $data=array();
    $response=array();
    $response['status']=1;
    $response['data']=array();
    foreach ($cur as $tupla)
    {
        $data[$tupla['idcompositor']]=$tupla;
    }
    $response['data']=$data;
    echo json_encode($response);
?>