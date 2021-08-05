<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT id_usuario, Nombre FROM usuarios where Estatus='A' order by Nombre asc";
if ($result = $mysqli->query($sql)) {
    $res='';
    while ($row = $result->fetch_row()) {
        $res=$res."<option value='".$row[0]."'>".$row[1]."</option>";
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
echo $res;



$mysqli->close();
?>