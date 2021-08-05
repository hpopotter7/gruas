<?php 
//$tipo_grua=$_POST['tipo_grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT servicio, grua, nombre, ubicacion, DATE_FORMAT(salida, '%d/%c/%Y %H:%i'), SEC_TO_TIME(time_to_sec(timediff(NOW(), salida))) FROM servicio where llegada is null order by id_servicio desc";
if ($result = $mysqli->query($sql)) {
    $res='';
    while ($row = $result->fetch_row()) {
        $clase="";
        switch($row[1]){
            case "Plataforma":
                $clase='class="table-info"';
            break;
            case "Industrial":
                $clase='class="table-warning"';
            break;
            case "Grande":
                $clase='class="table-success"';
            break;
        }
        $largo=strlen($row[5]);
        $res=$res."<tr ".$clase.">
        <td class='datos' id='".$row[0]."'>".$row[0]."</td>
        <td class='datos' id='".$row[0]."'>".$row[1]."</td>
        <td class='datos' id='".$row[0]."'>".$row[2]."</td>
        <td class='datos' id='".$row[0]."'>".$row[3]."</td>
        <td class='datos' id='".$row[0]."'>".$row[4]."</td>
        <td class='datos' id='".$row[0]."'>".substr($row[5],0,$largo-3)."</td>
        </tr>";
    }
    $result->close();
}
else{
    $res= $sql."<br>".mysqli_error($mysqli);
}

if($res==""){
    $res="<tr class='table-dark'><td style='text-align:center;color:white !important' colspan='6'><h4>No hay servicios</h4></td></tr>";

}
echo $res;

$mysqli->close();
?>