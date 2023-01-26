<?php
//include server header
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/auth/secure.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';

$name = "testBuilding";
$datum = date('Y-m-d H:i:s');
echo $datum;
$sql = "INSERT INTO buildings (name,date_created) VALUES (:name,:datum)";
$statement = $db_conn->prepare($sql);
$statement->bindParam(':name', $name);
$statement->bindParam(':datum', $datum);

$bool = $statement->execute();

if ($bool) {
    echo "succes";
} else {
    echo "failed";
}
