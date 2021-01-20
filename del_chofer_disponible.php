<?php 
$chofer=$_POST['chofer'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");

$sql="delete from disponibles where chofer='".$chofer."'";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= mysqli_error($mysqli);
}


$array_plataforma=Array();
$sql="select chofer from disponibles where tipo_grua='Plataforma' order by no asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
       array_push($array_plataforma,$row[0]);
    }
    $result->close();
}
$array_grande=Array();
$sql="select chofer from disponibles where tipo_grua='Grande' order by no asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
       array_push($array_grande,$row[0]);
    }
    $result->close();
}
$array_industrial=Array();
$sql="select chofer from disponibles where tipo_grua='Industrial' order by no asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
       array_push($array_industrial,$row[0]);
    }
    $result->close();
}


$no=1;
for($r=0;$r<=count($array_grande)-1;$r++){
    $sql="update disponibles set no=".$no." where chofer='".$array_grande[$r]."' and tipo_grua='Grande'";
    if ($mysqli->query($sql)) {
        $res="Exito";
    }
    $no++;
}
$no=1;
for($r=0;$r<=count($array_plataforma)-1;$r++){
    $sql="update disponibles set no=".$no." where chofer='".$array_plataforma[$r]."' and tipo_grua='Plataforma'";
    if ($mysqli->query($sql)) {
        $res="Exito";
    }
    $no++;
}
$no=1;
for($r=0;$r<=count($array_industrial)-1;$r++){
    $sql="update disponibles set no=".$no." where chofer='".$array_industrial[$r]."' and tipo_grua='Industrial'";
    if ($mysqli->query($sql)) {
        $res="Exito";
    }
    $no++;
}

echo $res;

$mysqli->close();
?>