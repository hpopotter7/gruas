<?php 
$txt_nombre=$_POST['txt_nombre'];
$txt_user=$_POST['txt_user'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$res="";
$sql="select Nombre from usuarios where user='".$txt_user."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        $res="Ya existe un usuario: ".$txt_user;   
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}

if($res==""){
    $sql="insert into usuarios (user, pass, nombre) values('".$txt_user."', 'gruas2021', '".$txt_nombre."')";
    if ($mysqli->query($sql)) {
        $res='Exito';
    }
    else{
        $res= mysqli_error($mysqli);
    }
}

echo $res;

$mysqli->close();
?>