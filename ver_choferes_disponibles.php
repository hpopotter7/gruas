<?php 
$tipo_grua=$_POST['tipo_grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT no, chofer FROM  disponibles where  tipo_grua='".$tipo_grua."' order by no asc";
if ($result = $mysqli->query($sql)) {
    $res='<tbody>';
    while ($row = $result->fetch_row()) {
        $res=$res."<tr class='table-primary'><td style='color:white !important; font-size:1.2em'>".$row[0]."</td><td style='color:white !important;font-size:1.2em'>".$row[1]."</td></tr>";
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
echo $res."</tbody>";



$mysqli->close();
?>