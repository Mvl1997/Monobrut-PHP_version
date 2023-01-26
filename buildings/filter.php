<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
//include the DB connection
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';


if (isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
} else {
    echo 'no categories selected';
    exit();
}
$data = array();
//SELECT * FROM `buildings` WHERE `idcategories` = 1
$sql = "SELECT * FROM buildings WHERE idcategories =:category";
$stmnt = $db_conn->prepare($sql);
$stmnt->bindParam(":category", $category);
$stmnt->execute();

while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

echo '<pre>';
print_r($data);
echo '</pre>';
?>
<?php foreach ($data as $index => $building) { ?>

    <div class="building-card">
        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/monobrut/uploadFiles/<?= $building['base_img'] ?>">
        <p class="title"><?= $building['name'] ?></p>
        <p class="city"><?= $building['city'] ?></p>
        <a href="#">Information</a>
    </div>
<?php } ?>