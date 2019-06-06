<?php
    include_once("../../Utilerias/BaseDatos.php");
    header('content-type: application/json; charset=utf-8');
    $method=$_SERVER['REQUEST_METHOD'];
    $response=array();
    $result = consultacursos();
if (!empty($result)) {
    $response["success"]="200";
    $response["message"]="curso encontrado";
    $response["curso"]=array();
    foreach ($result as $tupla) 
    {
        array_push($response["curso"], $tupla);
    }
}
else
    {
        $response["success"]="204";
        $response["message"]="cursono encontrado";
    }
    echo json_encode($response);

    
?>