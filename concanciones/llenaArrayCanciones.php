<?php
    include_once("../Utilerias/BaseDatos.php");
    
    $cur = cargaCanciones();
    $data=array();
    $response=array();
    $response['status']=1;
    $response['data']=array();
    foreach ($cur as $tupla)
    {
        $data[$tupla['idcancion']]=$tupla;
    }
    $response['data']=$data;
    //echo "<pre>";
    //print_r($R);
    //echo "</pre>";
    //die("Muere");
    echo json_encode($response);
?>