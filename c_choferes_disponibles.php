<?php 
$grua=$_POST['grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$array=Array();
$sql="select Nombre_completo from choferes where ".$grua."='X' order by Nombre_completo asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {        
        array_push($array,$row[0]);        
    }
    $result->close();
}
else{
    $res= mysqli_error($mysqli);
}
$querys=$sql;
$res='<option value="">Selecciona...</option>';
for($r=0;$r<=count($array)-1;$r++){
    $sql="select chofer from disponibles where chofer='".$array[$r]."' and tipo_grua='".$grua."'";
    $CHOFER="";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {        
                $CHOFER=$row[0];
        }
        $result->close();
    }
    else{
        $res= mysqli_error($mysqli);
    }

    if($CHOFER==""){
        $res=$res."<option value='".$array[$r]."'>".$array[$r]."</option>"; 
    }
    else{
        $res=$res."<option value='".$array[$r]."' disabled style='color:red'>".$array[$r]."</option>";
    }
    $querys=$querys.$sql;
}



echo $res;

$mysqli->close();
?>