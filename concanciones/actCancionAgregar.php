<?php
    include_once("../Utilerias/BaseDatos.php");
    $post = $_POST;
    $XFile = $_FILES["arch"];
    $directorio = "../img/";
    $nomArch = md5($XFile["name"]);
    $tipoArchivo = strtolower(pathinfo($XFile["name"],PATHINFO_EXTENSION));
    $nomArch = $directorio . $nomArch . ".$tipoArchivo";
    //----------------------------------------------------
    $Xcan = $_FILES["can"];
    $nomSound=$Xcan['name'].time();
    $directoriom = "../Sounds/";
    $Tipocancion = strtolower(pathinfo($Xcan['name'],PATHINFO_EXTENSION));
    $nomSound=$directoriom.$nomSound.".$Tipocancion";
    if (move_uploaded_file($XFile["tmp_name"],$nomArch)&&move_uploaded_file($Xcan["tmp_name"],$nomSound)){
        $res = cancionAgrega($post, $nomArch, $nomSound);
        $post['idtipgenero']=$post['gen'];
            //consultaIdGenero($post['idtipgenero'])[0]['genero'];
        $post['idtipcom']=$post['comp'];
            //consultaCompId($post['idtipcom'])[0]['nomc'];
        $post["pk"]= $res;
        $response['status'] = true;
        $response['data'] = $post;
        $response['data']['imagen']=$nomArch;
        $response['data']['mp3']=$nomSound;
    }else{
        $response['status'] = false;
        $response['data'] = $post;
    }
    echo json_encode($response);
?>
