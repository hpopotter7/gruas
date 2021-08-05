<?php     

$user=$_POST['user'];
$pass=$_POST['pass'];
$res="No existe";
$perfil="";
//$mysqli = new mysqli("209.59.139.52:3306", "admini27_gruas", "M@trix2020.", "admini27_gruas");
$mysqli = new mysqli("localhost", "admini27_gruas", "M@trix2020.", "admini27_gruas");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT Nombre, perfil FROM usuarios where User='".$user."' and Pass='".$pass."' and Estatus='A'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        if($pass=="gruas2021"){
            setcookie("opcion", "primera");
            $perfil=$row[1];
        }
        else{
            $res=$row[0];
            $perfil=$row[1];
        }
    }
    $result->close();
}
    setcookie("user", $res);
    setcookie("perfil", $perfil);
    setcookie("start", time());
$mysqli->close();

if ($res=="No existe"){
    header('Location:index.php');
}
else if ($res=="Cambio de pass"){    
    header('Location:inicio.php');
}
else if($res!=""){
    header('Location:inicio.php');
}
else{
    header('Location:index.php');
 }
 

?>