<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos = gentipo();
    foreach ($cursos as $tupla )
    {
        $id= $tupla['idgenero'];
        $nom = $tupla['genero'];
        echo "<option value='$id'>$nom</option>";
    } 
?>