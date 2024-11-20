<?php 

session_start();

unset($_SESSION['username']);
unset($_SESSION['id_users']);

session_unset();

session_destroy();

header("location: ../login.php?pesan=logout");
exit;
?>