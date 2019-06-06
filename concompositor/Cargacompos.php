<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos =  cargacomp();
    foreach ($cursos as $tupla )
    {
        echo "<tr id='". $tupla['idcompositor'] . "'>
            <td>" . $tupla['nomc'] . "</td>
            <td>
                <i class='material-icons edit' id-record='" . $tupla['idcompositor'] . "'>create</i>
                <i class='material-icons delete' id-record='". $tupla['idcompositor'] . "'>delete_forever</i>
            </td>
        </tr>";
    } 
?>