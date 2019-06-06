<?php
try{
        $Cn = new PDO('pgsql:host=localhost;port=5432;dbname=musicx;user=postgres;password=hola');
        //$Cn = new PDO('mysql:host=localhost; dbname=bdalumnos','root','');
        $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
        //$Cn->exec("SET CHARACTER SET utf8");
}catch(Exception $e){
    die("Error: " . $e->GetMessage());
}

// Función para ejecutar consultas SELECT
function Consulta($query)
{
    global $Cn;
    try{    
        $result =$Cn->query($query);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
}

function Ejecuta ($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $result->closeCursor();
        return 1; // Exito  
    } catch (Exception $e) {
        //die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
        return 0; // Fallo
    }
}
//------------------------------------------------------------
function registraUsr($post,$ids)
{
    $correo = $post["corr"];
    $nom = $post["nom"];
    $pwd = $post["pwd"];
    $pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO "musica".usuario(correo,nomusuario,contra,tipousr,idsession)' . 
    "values('$correo','$nom','$pwdEnc',1,'$ids')";

    return Ejecuta($sql);
}

function validaUsr($post,$idSess)
{
    $correo = $post["correo"];
    $contra = $post["contra"];
    $sql = 'SELECT contra,tipousr FROM "musica".usuario  WHERE correo like ' . "'" . $correo . "'";
    $res = Consulta($sql);
    $pwdEnc = "";
    $tipo = 0;
    foreach ($res as $tupla )
    {
        $pwdEnc = $tupla['contra'];
        $tipo = $tupla['tipousr'];
    }
    if (password_verify($contra, $pwdEnc) )
    {   
        $sql = 'UPDATE "musica".usuario SET ' . "idsession='$idSess' WHERE correo like'$correo'";
        //die($sql);
        if (Ejecuta($sql))
            return $tipo;
        else
            return 0;
    }
    else{
        return 0;
    }
}

function validaSess(&$correo, &$tu, &$idsess){
    $correo = $correo;
    $sql = 'SELECT idsession,tipousr FROM "musica".usuario  WHERE correo like ' . "'" . $correo . "'";
    $res = Consulta($sql);
    $tipo = 0;
    foreach ($res as $tupla )
    {
        $idsess = $tupla['idsession'];
        $tu = $tupla['tipousr'];
    }   
    return 0;
}

/////usuarios

function EjecutaConsecutivousuario($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado[0]['idusuario'];
    } catch (Exception $e) {
        die("Error en la linea: " + $e->getLine() + 
        " MSG: " + $e->GetMessage());
        return 0;
    }
}

function cargausuario(){
    $query = 'SELECT idusuario, correo, nomusuario, contra, tipousr, idsession FROM "musica"."usuario" ORDER BY correo';
    return Consulta($query);
}

function agregausuario($post){
    $corr = $post['corr'];
    $nom = $post['nom'];
    $pwd = $post['pwd'];
    $sentencia = 'INSERT INTO "Escuela".usuario(correo,nomusuario,contra,tipousr,idsession)' . 
    "values('$correo','$nom','$pwdEnc',1,'$ids')RETURNING idusuario";          
    return EjecutaConsecutivousuario($sentencia);
}

function borrausuario($post){
    $id = $post["pk"];
    $sentencia = 'DELETE FROM "musica".usuario WHERE idusuario='.$id;
    return Ejecuta($sentencia);
}

function actualizausuario($post){
    $id = $post["pk"];
    $corr = $post['corr'];
    $nom = $post['nom'];
    $sentencia = 'UPDATE "musica".usuario SET ' . "correo='$corr', nomusuario='$nom' WHERE idusuario=$id"; 
    return Ejecuta($sentencia);
    }
    //Web Service de usuarios

    function consultausuarios(){
        $query = 'SELECT idusuario, correo, nomusuario, tipousr FROM "musica"."usuario" ORDER BY correo'; 
        return Consulta($query);
    }
    function consultausuarioser($idusu){
        $query = 'SELECT idusuario, correo, nomusuario, tipousr FROM "musica"."usuario"'. "WHERE idusuario=$idusu";
        return Consulta($query);
    }
    
    function agregausuarioser($post){
        $corr = $post['correo'];
        $nom = $post['nomusuario'];
        $sentencia = 'INSERT INTO "Escuela".usuario(idusuario,correo,nomusuario,tipousr)' . 
        "values('$corr','$nom',1)RETURNING idusuario";          
        return EjecutaConsecutivousuario($sentencia);
    }
    
    function borrausuarioser($post){
        $id = $post["idusuario"];
        $sentencia = 'DELETE FROM "musica".usuario WHERE idusuario='.$id;
        return Ejecuta($sentencia);
    }
    
    function actualizausuarioser($post){
        $id = $post["idusuario"];
        $corr = $post['correo'];
        $nom = $post['nomusuario'];
        $sentencia = 'UPDATE "musica".usuario SET ' . "correo='$corr', nomusuario='$nom' WHERE idusuario=$id"; 
       // echo $sentencia;
       // die("hjgjgjg");
        return Ejecuta($sentencia);
    //fin web services
    }
//Fin usuarios

//Inicia genero
function EjecutaConsecutivogenero($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado[0]['idgenero'];
    } catch (Exception $e) {
        die("Error en la linea: " + $e->getLine() + 
        " MSG: " + $e->GetMessage());
        return 0;
    }
}
function cargageneros(){
    $query = 'SELECT idgenero, genero FROM "musica"."genero" ORDER BY genero';
    return Consulta($query);
}
function agregagenero($post){
    $gen = $post['genero'];
    $sentencia = 'INSERT INTO "musica".genero(genero)' . 
                 "values('$gen'
                 ) RETURNING idgenero";
    return EjecutaConsecutivogenero($sentencia);
}

function borragenero($post){
    $id = $post["pk"];
    $sentencia = 'DELETE FROM "musica".genero WHERE idgenero='.$id;
    return Ejecuta($sentencia);
}

function actualizagenero($post){
    $id = $post["pk"];
    $gen = $post["genero"];
    $sentencia = 'UPDATE "musica".genero SET ' . "genero='$gen' WHERE idgenero=$id"; 
    return Ejecuta($sentencia);
}

//inicia web service genero
function cargagenerosser(){
    $query = 'SELECT idgenero, genero FROM "musica"."genero" ORDER BY genero';
    return Consulta($query);
}
function cargageneroser($idgen){
    $query = 'SELECT idgenero, genero FROM "musica"."genero"'."WHERE idgenero=$idgen"; 
    return Consulta($query);
}

function agregageneroser($post){
    $gen = $post['genero'];
    $sentencia = 'INSERT INTO "musica".genero(genero)' . 
                 "values('$gen'
                 ) RETURNING idgenero";
    return EjecutaConsecutivogenero($sentencia);
}

function borrageneroser($post){
    $id = $post["idgenero"];
    $sentencia = 'DELETE FROM "musica".genero WHERE idgenero='.$id;
    return Ejecuta($sentencia);
}

function actualizageneroser($post){
    $id = $post["idgenero"];
    $gen = $post["genero"];
    $sentencia = 'UPDATE "musica".genero SET ' . "genero='$gen' WHERE idgenero=$id"; 
    return Ejecuta($sentencia);
// web services genero fin
//Fin genero

function tipogenero(){
    $query = 'SELECT idgenero, genero FROM "musica"."genero"
    ORDER BY genero';
    return Consulta($query);
}
function tipocompositor(){
    $query = 'SELECT idcompositor, nomc FROM "musica"."compositor"
    ORDER BY nomc';
    return Consulta($query);
}
function consultaGeneroId($id){
    $query = 'SELECT idgenero, genero FROM "musica"."genero" WHERE idgenero='.$id;
    return Consulta($query);
}
function consultaIdGenero($id){
    $query = 'SELECT idgenero, genero FROM "musica"."genero" WHERE idgenero='.$id;
    return Consulta($query);
}
function consultaCompId($id){
    $query = 'SELECT idcompositor, nomc FROM "musica"."compositor" WHERE idcompositor='.$id;
    return Consulta($query);
}
//Termina canciones
}
function cargaEntrada(){
    $query = 'SELECT c.idcancion,c.nomcancion, c.fechacancion, c.imagen,c.mp3, g.genero, n.nomc from "musica".cancion as c inner join
    "musica".genero as g on c.idgenero=g.idgenero  inner join "musica".compositor as n  on c.idcompositor=n.idcompositor';
    return Consulta($query);   
}


function xd(){
    $query = 'SELECT c.idcancion,c.nomcancion, c.fechacancion, c.imagen,c.mp3, g.genero, n.nomc from "musica".cancion as c inner join
    "musica".genero as g on c.idgenero=g.idgenero  inner join "musica".compositor as n  on c.idcompositor=n.idcompositor';
    return Consulta($query);   
}
function bca($post){
    $id = $post["pk"];
    $sentencia = 'DELETE FROM "musica".cancion WHERE idcancion=' . $id;
    return Ejecuta($sentencia);
}

function aca($post, $nomArch, $nomSound){
    $id = $post["pk"];
    $nomcan = $post['nomcancion'];
    $fechap = $post['fechapub'];
    $genero = $post['genero'];
    $artista = $post['artista'];
    $sentencia = 'UPDATE "musica".cancion SET ' . "nomcancion='$nomcan', fechacancion='$fechap',idgenero=$genero, idcompositor=$artista, imagen='$nomArch', mp3='$nomSound' WHERE idcancion=$id"; 
   // echo $sentencia;
   // die("hjgjgjg");
   die($sentencia);
    return Ejecuta($sentencia);

}
function gentipo(){
    $query = 'SELECT idgenero, genero FROM "musica"."genero"
    ORDER BY genero';
    return Consulta($query);
}
function comptipo(){
    $query = 'SELECT idcompositor, nomc FROM "musica"."compositor"
    ORDER BY nomc';
    return Consulta($query);
}
function cancionAgrega($post,$nomArch, $nomSound){
    $nomcan = $post['nomcancion']; 
    $fechap = $post['fechapub'];
    $genero = $post['idtipgenero'];
    $artista = $post['idtipcom'];

    $sentencia = 'INSERT INTO "musica".cancion(nomcancion,fechacancion,idgenero, idcompositor,imagen, mp3)'. 
                 "values('$nomcan','$fechap',$genero,$artista,'$nomArch', '$nomSound') RETURNING idcancion";
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado[0]['idcancion'];
    } catch (Exception $e) {
        die("Error en la linea: " + $e->getLine() + 
        " MSG: " + $e->GetMessage());
        return 0;
    }
}

function cargacomp(){
    $query = 'SELECT idcompositor, nomc FROM "musica"."compositor" ORDER BY nomc';
    return Consulta($query);

}

function ac($post){
    $id = $post["pk"];
    $nomcomp = $post["comp"];
    $sentencia = 'UPDATE "musica".compositor SET ' . "nomc='$nomcomp' WHERE idcompositor=$id"; 
   // echo $sentencia;
   // die("hjgjgjg");
    return Ejecuta($sentencia);

}
function bc($post){
    $id = $post["pk"];
    $sentencia = 'DELETE FROM "musica".cancion WHERE idcancion=' . $id;
    return Ejecuta($sentencia);
}
function ic($post){
    $nomcomp = $post['comp'];
    $sentencia = 'INSERT INTO "musica".compositor(nomc)' . 
                 "values('$nomcomp'
                 ) RETURNING idcompositor";
                global $Cn;
                 try {
                     $result = $Cn->query($sentencia);
                     $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
                     $result->closeCursor();
                     return $resultado[0]['idcompositor'];
                 } catch (Exception $e) {
                     die("Error en la linea: " + $e->getLine() + 
                     " MSG: " + $e->GetMessage());
                     return 0;
                 }
}