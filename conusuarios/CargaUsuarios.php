<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos = cargausuario();
    foreach ($cursos as $tupla )
    {
        echo "<tr id='". $tupla['idusuario'] . "'>
            <td>" . $tupla['correo'] . "</td>
            <td>" . $tupla['nomusuario'] . "</td>
            <td>" . $tupla['tipousr'] . "</td>
            <td>
                <i class='material-icons edit' id-record='" . $tupla['idusuario'] . "'>create</i>
                <i class='material-icons delete' id-record='". $tupla['idusuario'] . "'>delete_forever</i>
            </td>
        </tr>";
    } 
?>