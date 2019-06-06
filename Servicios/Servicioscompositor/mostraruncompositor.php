<?php 
    include_once("../../Utilerias/BaseDatos.php");
    header('Content-type: application/json; charset=utf-8');
    $method=$_SERVER['REQUEST_METHOD'];

    $obj = json_decode( file_get_contents('php://input') );   
    $objArr = (array)$obj;
	if (empty($objArr))
    {
		$response["success"] = 422;  //No encontro información 
        $response["message"] = "Error: checar json entrada";
        header($_SERVER['SERVER_PROTOCOL']." 422  Error: faltan parametros de entrada json ");		
    }
    else
    {
	    $idcom =  $objArr['idcompositor'];
	    $response = array();
        $result = cargacompser($idcom);
        if (!empty($result)) {
            $response["success"] = "200";
            $response["message"] = "curso encontrados";

            $response["compositor"] = array();
            foreach ($result as $tupla)
            {
                array_push($response["compositor"], $tupla);
            }
        }
        else{
            $response["success"] = "204";
            $response["message"] = "cursos no encontrados";
            header($_SERVER['SERVER_PROTOCOL'] . " 500  Error interno del servidor ");
        }
    }
        echo json_encode($response);
?>