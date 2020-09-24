<?php 
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
    $sql="select datos from observaciones";
    if ($result = $mysqli->query($sql)) {
        $res='';
        while ($row = $result->fetch_row()) {
            $resultado=$row[0];
        }
        $result->close();
    }
    else{
        $res= $sql."<br>".mysqli_error($mysqli);
    }
    echo $resultado;
	$mysqli->close();
?>