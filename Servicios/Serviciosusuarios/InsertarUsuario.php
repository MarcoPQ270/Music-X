<?php 
    include_once("../../Utilerias/BaseDatos.php");
    header('Content-type: application/json; charset=utf-8');//configurar el header
    $method=$_SERVER['REQUEST_METHOD'];//recibirmos el metodo atraves del cual vamos a recibir la informacion

    $obj = json_decode( file_get_contents('php://input') );   
    $objArr = (array)$obj;
	if (empty($objArr))//si el arreglo es vacio manda esto
    {
		$response["success"] = 422;  //No encontro información 
        $response["message"] = "Error: checar json entrada";
        header($_SERVER['SERVER_PROTOCOL']." 422  Error: faltan parametros de entrada json ");		
    }
    else
    {
	    $response = array();
        $result = agregausuarioser($objArr);
        if ($result) {
            $response["success"] = "201";
            $response["message"] = "Se agrego el usuario";
           }
        else{
            $response["success"] = "409";
            $response["message"] = "El usuario no se Agrego";
            header($_SERVER['SERVER_PROTOCOL'] . " 409  Conflicto de insertar");
        }
    }
        echo json_encode($response);
?>