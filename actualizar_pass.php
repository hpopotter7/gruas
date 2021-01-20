<?php 
$pass=$_POST['pass'];
$user=$_COOKIE['user'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");

$sql="update usuarios set pass='".$pass."' where Nombre='".$user."'";
if ($mysqli->query($sql)) {
    $res='Contraseña actualizada!';
    setcookie ("opcion", "", time() - 3600);
}
else{
    $res= mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>