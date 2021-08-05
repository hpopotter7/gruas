<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT id_choferes, nombre_completo from choferes where estado='A' order by nombre_completo asc";
if ($result = $mysqli->query($sql)) {
    $res='<option val="vacio">Selecciona...</option>';
    while ($row = $result->fetch_row()) {
        $res=$res."<option val='".$row[0]."'>".$row[1]."</option>";
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
echo $res;
$mysqli->close();
?>