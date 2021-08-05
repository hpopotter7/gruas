<?php 
$txt_nombre=$_POST['txt_nombre'];
$txt_phone=$_POST['txt_phone'];
$check_plataforma="";
$check_industrial="";
$check_grande="";

if(isset($_POST['check_plataforma'])){
    $check_plataforma=$_POST['check_plataforma'];
}
if(isset($_POST['check_industrial'])){
    $check_industrial=$_POST['check_plataforma'];
}
if(isset($_POST['check_grande'])){
    $check_grande=$_POST['check_grande'];
}


include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");

$sql="insert into choferes (nombre_completo, telefono, fecha_registro, Plataforma, Industrial, Grande) values('".$txt_nombre."', '".$txt_phone."', NOW(), '".$check_plataforma."', '".$check_industrial."', '".$check_grande."')";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= "Error: ".mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>