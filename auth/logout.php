<?php
session_start();
session_destroy();
$pathLogin = "http://" . $_SERVER["HTTP_HOST"] . '/monobrut/login.php';

header("Location:" . $pathLogin);
exit;
