<?php 
    include_once("../../Utilerias/BaseDatos.php");
    header('Content-type: application/json; charset=utf-8');//consigurar el header
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
    {//si es correcto entra y extrae el numeri de control 
        // $noc =  $objArr['nocontrol'];
        // $carr =  $objArr['carrera'];
        // $nom =  $objArr['nombre'];
        // $tel =  $objArr['telefono'];
	    $response = array();
        $result = eliminarcursoser($objArr);
        if ($result) {
            $response["success"] = "201";
            $response["message"] = "Se elimino wl curso";
            //$response["alumno"] = array();
        //     foreach ($result as $tupla)
        //     {
        //         array_push($response["alumno"], $tupla);
        //     }
        }
        else{
            $response["success"] = "409";
            $response["message"] = "El Curso no se elimino";
            header($_SERVER['SERVER_PROTOCOL'] . " 409  Conflicto de insertar");
        }
    }
        echo json_encode($response);
?>