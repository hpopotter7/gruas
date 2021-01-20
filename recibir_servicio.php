<?php 
$folio=$_POST['folio'];
$tipo=$_POST['tipo'];
$llegada=$_POST['llegada'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$sql="select Salida, nombre, grua, SEC_TO_TIME(time_to_sec(timediff(NOW(), salida))), DATE_FORMAT(NOW(), '%Y-%m-%d') from servicio where servicio='".$folio."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $salida=$row[0];
        $chofer=$row[1];
        $grua=$row[2];
        $duracion=$row[3];
        $hoy=$row[4];
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}


$sql="update servicio set Llegada='".$llegada."', Duracion='".$duracion."', Tipo='".$tipo."', Facturable='Si' where servicio='".$folio."'";
if ($mysqli->query($sql)) {
    $res='recibido exitoso#'.$chofer."#".$grua;
    
}
else{
    $res= mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>