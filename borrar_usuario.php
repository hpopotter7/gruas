<?php 
$nombre=$_POST['nombre'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");

$sql="delete from usuarios where Nombre='".$nombre."'";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>