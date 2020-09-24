<?php 
$chofer=$_POST['chofer'];
$grua=$_POST['grua'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$no="";
$array=Array();
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select Plataforma, Grande, Industrial from choferes where Nombre_completo='".$chofer."'";
if ($result = $mysqli->query($sql)) {
    $res='';
    while ($row = $result->fetch_row()) {
        array_push($array,$row[0]);
        array_push($array,$row[1]);
        array_push($array,$row[2]);
    }
    $result->close();
}
else{
    $res= $sql."<br>".mysqli_error($mysqli);
    echo $sql;
    exit();
}
for($r=0;$r<=count($array)-1;$r++){
    
    $grua="";
    if($r==0){
        $grua="Plataforma";
    }
    if($r==1){
        $grua="Grande";
    }
    if($r==2){
        $grua="Industrial";
    }
    $sql="select max(no) from disponibles where tipo_grua='".$grua."'";
    $ultimo=0;
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $ultimo=$row[0];
        }
        $result->close();
    }
    else{
        $res= $sql."<br>".mysqli_error($mysqli);
        echo $sql;
        exit();
    }
    $ultimo=$ultimo+1;
    
    if($array[$r]=="X"){
        $sql="insert into disponibles (chofer, tipo_grua, no) values('".$chofer."', '".$grua."', '".$ultimo."')";
        if ($mysqli->query($sql)) {
            $res='Exito';
        }
        else{
            $res= mysqli_error($mysqli)."-".$sql;
        }
    }
    
}

echo $res;

$mysqli->close();
?>