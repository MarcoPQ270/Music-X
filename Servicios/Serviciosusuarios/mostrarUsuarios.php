<?php
    include_once("../../Utilerias/BaseDatos.php");
    header('content-type: application/json; charset=utf-8');
    $method=$_SERVER['REQUEST_METHOD'];
    $response=array();
    $result = consultausuarios();
if (!empty($result)) {
    $response["success"]="200";
    $response["message"]="usuario encontrado";
    $response["usuario"]=array();
    foreach ($result as $tupla) 
    {
        array_push($response["usuario"], $tupla);
    }
}
else
    {
        $response["success"]="204";
        $response["message"]="Usuario no encontrado";
        
    }
    echo json_encode($response);

    
?>