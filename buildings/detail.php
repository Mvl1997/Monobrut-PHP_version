<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
//include the DB connection
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';


if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
} else {
    echo 'no id selected';
    exit();
}
//$data = array();
//SELECT * FROM `buildings` WHERE `idcategories` = 1
$sql = "SELECT * FROM buildings WHERE idbuildings =:id";
$stmnt = $db_conn->prepare($sql);
$stmnt->bindParam(":id", $id);
$stmnt->execute();

$building = $stmnt->fetch(PDO::FETCH_ASSOC);
// while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
//     $data[] = $row;
// }

echo '<pre>';
print_r($building);
echo '</pre>';
?>

<a href="../index.php">Go back </a>
<div class="building-card">
    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/monobrut/uploadFiles/<?= $building['base_img'] ?>">
    <p class="title"><?= $building['name'] ?></p>
    <p class="city"><?= $building['city'] ?></p>
    <a href="#">Information</a>
</div>