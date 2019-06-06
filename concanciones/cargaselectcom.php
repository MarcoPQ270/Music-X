<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos = comptipo();
    foreach ($cursos as $tupla )
    {
        $id= $tupla['idcompositor'];
        $nom = $tupla['nomc'];
        echo "<option value='$id'>$nom</option>";
    } 
?>