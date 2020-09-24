<?php 
$chofer=$_POST['chofer'];
$grua=$_POST['grua'];
$destino=$_POST['destino'];
$folio=$_POST['folio'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select servicio from servicio where servicio='".$folio."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $res="duplicado";
    }
    $result->close();
}
else{
    $res= $sql."<br>".mysqli_error($mysqli);
}
if($res=="duplicado"){
    echo $res;
    exit();
}

$sql="insert into servicio (nombre, grua, ubicacion, servicio, salida) values('".$chofer."', '".$grua."', '".$destino."', '".$folio."', NOW())";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= mysqli_error($mysqli);
    echo $res;
    exit();
}


$sql="delete from disponibles where chofer='".$chofer."' and tipo_grua='".$grua."'";
if ($mysqli->query($sql)) {
    $res='Exito';
}
else{
    $res= mysqli_error($mysqli);
    echo $res;
    exit();
}

$array=Array();
$sql="select chofer from disponibles where tipo_grua='".$grua."' order by no asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
       array_push($array,$row[0]);
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
    echo $res;
    exit();
}

$no=1;
for($r=0;$r<=count($array)-1;$r++){
    $sql="update disponibles set no=".$no." where chofer='".$array[$r]."' and tipo_grua='".$grua."'";
    if ($mysqli->query($sql)) {
        $res="Exito";
    }
    else{
        $res= mysqli_error($mysqli);
        echo $res;
        exit();
    }
    $no++;
}

echo $res;

$mysqli->close();
?>