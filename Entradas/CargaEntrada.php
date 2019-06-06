<?php
    include_once('../Utilerias/BaseDatos.php');
    $cursos = cargaEntrada();
    foreach ($cursos as $tupla )
    {
echo"<div class=''>
        <div  class='col s12 m3'>
          <div class='card'>
            <div class='card-image'>
                <img src='../img/" . $tupla['imagen'] ."'height='300' />
                 <audio 
                    src='../sounds/". $tupla['mp3'] ."' controls='controls' type='audio/mpeg' preload='preload'>
                </audio>
                <h6 align='center'> Titulo: ". $tupla['nomcancion'] ."<h6>
            <h6 align='center'> Artista: ". $tupla['nomc'] ."<h6>
            <h6 align='center'> Genero: ". $tupla['genero'] ."<h6>
            </div>  
        <div class='card-action'>
          <a href='#' class='pink-text'></a>
        </div>
      </div>
    </div>
  </div>
";
    } 
?>
