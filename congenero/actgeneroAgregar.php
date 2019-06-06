<?php
    include_once("../Utilerias/BaseDatos.php");
    $post = $_POST;
    $res = agregagenero($post);
    if ($res){
        $post["pk"]= $res;
        $response['status'] = true;
        $response['data'] = $post;
        
    }else{
        $response['status'] = false;
        $response['data'] = $post;
    }
    echo json_encode($response);

?>