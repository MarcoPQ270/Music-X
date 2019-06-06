<?php
    include_once("../../Utilerias/BaseDatos.php");
    header('content-type: application/json; charset=utf-8');
    $method=$_SERVER['REQUEST_METHOD'];
    $response=array();
    $result = cargagenerosser();
if (!empty($result)) {
    $response["success"]="200";
    $response["message"]="Genero encontrado";
    $response["genero"]=array();
    foreach ($result as $tupla) 
    {
        array_push($response["genero"], $tupla);
    }
}
else
    {
        $response["success"]="204";
        $response["message"]="Usuario no encontrado";
        
    }
    echo json_encode($response);

    
?>