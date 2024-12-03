<?php
session_start();
session_destroy(); // Cerrar la sesión
header('Location: login.php'); // Redirigir al login
exit;
?>
