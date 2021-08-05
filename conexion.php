<?php 
$mysqli = new mysqli("localhost", "admini27_gruas", "M@trix2020.", "admini27_gruas");
//$mysqli = new mysqli("209.59.139.52:3306", "admini27_gruas", "M@trix2020.", "admini27_gruas");


if (isset($_COOKIE['user'])){
  $secondsInactive = time() - $_COOKIE['start'];
  if ($secondsInactive > (60*60)) {  //en segundos una hora
      
      setcookie ("user", "caducada", time() - 3600);
      setcookie ("nombre", "", time() - 3600);
      setcookie ("start", "", time() - 3600);
              echo '<script>console.log("uno")</script>';
  }
  else{
      setcookie("start", time());
  }
}

if (!isset($_COOKIE['user'])){
  echo '<script>window.location="logout.php"</script>';
  

}




?>

