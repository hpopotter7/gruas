<?php 
    $folio=$_POST["folio"];
    
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	
    $sql="SELECT nombre, grua from servicio where servicio='".$folio."'";
    
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
            $return = Array('chofer'=>$row[0],
                            'grua'=>$row[1],
                            'error'=>"nada",
                            );
            
		}
		$result->close();
	}
	else{
		$return = Array('error'=>"Error: ".mysqli_error($mysqli));
        
	}
    echo json_encode($return);
    
	
	$mysqli->close();
	

?>