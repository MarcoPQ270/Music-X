<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos = cargageneros();
    foreach ($cursos as $tupla )
    {
        echo "<tr id='". $tupla['idgenero'] . "'>
            <td>" . $tupla['genero'] . "</td>
            <td>
                <i class='material-icons edit' id-record='" . $tupla['idgenero'] . "'>create</i>
                <i class='material-icons delete' id-record='". $tupla['idgenero'] . "'>delete_forever</i>
            </td>
        </tr>";
    } 
?>