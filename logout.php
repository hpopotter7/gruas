<?php
    setcookie ("user", "", time() - 3600);
    setcookie ("nombre", "", time() - 3600);
    setcookie ("start", "", time() - 3600);
    setcookie ("opcion", "", time() - 3600);
    setcookie ("perfil", "", time() - 3600);
    header('Location:index.php');
?>