<?php
include $_SERVER["DOCUMENT_ROOT"] . '/shared/header_dev.php';
include $_SERVER["DOCUMENT_ROOT"] . '/shared/config.php';

$sql = "select * from roles";
$statement = $db_conn->query($sql);
$fields = $statement->fetch(PDO::FETCH_ASSOC);

print_r($fields);
$db_conn = null;
exit();
