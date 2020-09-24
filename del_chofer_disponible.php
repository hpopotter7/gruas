<?php 
$chofer=$_POST['chofer'];
$grua=$_POST['grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");

$sql="delete from disponibles where chofer='".$chofer."' and tipo_grua='".$grua."'";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= mysqli_error($mysqli);
}
$array=Array();
$sql="select chofer from disponibles where tipo_grua='".$grua."' order by no asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
       array_push($array,$row[0]);
    }
    $result->close();
}
$no=1;
for($r=0;$r<=count($array)-1;$r++){
    $sql="update disponibles set no=".$no." where chofer='".$array[$r]."' and tipo_grua='".$grua."'";
    if ($mysqli->query($sql)) {
        $res="Exito";
    }
    $no++;
}

echo $res;

$mysqli->close();
?>