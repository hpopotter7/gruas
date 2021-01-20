<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$res='';
$sql="select DISTINCT(chofer) from disponibles order by chofer asc";

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}

echo $res;

$mysqli->close();
?>