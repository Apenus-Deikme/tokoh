<?php
session_start();
session_destroy();
header("Location: /tokoh/login.php");
exit;
?>