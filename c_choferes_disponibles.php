<?php 
$grua=$_POST['grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$CHOFER="";
$result = $mysqli->query("SET NAMES 'utf8'");
$todos=Array();
$ocupados=Array();
$res='<option value="">Selecciona...</option>';

$sql="select nombre from servicio where grua='".$grua."' and  llegada is null UNION select chofer as nombre from disponibles where tipo_grua='".$grua."' order by nombre asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        array_push($ocupados,$row[0]);  
        //echo $row[0];
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
//echo "<hr>";
$sql="select Nombre_completo from choferes where ".$grua."='X' order by Nombre_completo asc";
$tamaño=count($ocupados);

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        $chofer=$row[0];
        $pos=0;
        $bandera=false;
        while($pos<$tamaño){
            if($chofer==$ocupados[$pos]){
                $bandera=true;
                break;
            }
            $pos++;
        }
        if($bandera){
            $res=$res."<option value='".$chofer."' disabled style='color:red'>".$chofer."</option>";
        }
        else{
            $res=$res."<option value='".$chofer."'>".$chofer."</option>";
        }
        //echo $chofer;
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}

/*
$sql="select chofer from disponibles where tipo_grua='".$grua."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        array_push($ocupados,$row[0]);
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
*/

/* 
if($CHOFER==""){
    $res=$res."<option value='".$todos[$r]."'>".$todos[$r]."</option>"; 
}
else if (count($servicios)>0) {
    if(in_array($todos[$r], $servicios)){
        $res=$res."<option value='".$todos[$r]."' disabled style='color:red'>".$todos[$r]."</option>";
    }
}
else{
    $res=$res."<option value='".$todos[$r]."' disabled style='color:red'>".$todos[$r]."</option>";
} */


echo $res;

$mysqli->close();
?>