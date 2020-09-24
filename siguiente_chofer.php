<?php 
$grua=$_POST['grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select chofer from disponibles where tipo_grua='".$grua."' order by no asc limit 0, 1";
if ($result = $mysqli->query($sql)) {
    $res='vacio';
    while ($row = $result->fetch_row()) {
        $res=$row[0];
        break;
    }
    $result->close();
}
else{
    $res= $sql."<br>".mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>