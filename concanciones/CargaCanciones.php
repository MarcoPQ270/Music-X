<?php
    include_once('../utilerias/BaseDatos.php');
     $cursos = xd();
    foreach ($cursos as $tupla )
    {
        echo "<tr id='". $tupla['idcancion'] . "'>
            <td>" . $tupla['nomcancion'] . "</td>
            <td>" . $tupla['fechacancion'] . "</td>
            <td>" . $tupla['genero'] . "</td>   
            <td>" . $tupla['nomc'] . "</td>
            <td> <img src='../img/" . $tupla['imagen'] ."'width='80'/> </td>
            <td>  <audio 
            src='../sounds/". $tupla['mp3'] ."' controls='controls' type='audio/mpeg' preload='preload'>
        </audio> </td>

            <td>
                <i class='material-icons edit' id-record='" . $tupla['idcancion'] . "'>create</i>
                <i class='material-icons delete' id-record='". $tupla['idcancion'] . "'>delete_forever</i>
            </td>
        </tr>";
    } 
?>