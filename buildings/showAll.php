<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
//include the DB connection
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';

$data = array();
$sql = "SELECT * FROM Buildings";
$stmnt = $db_conn->query($sql);

while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
?>
<?php foreach ($data as $index => $building) { ?>

    <div class="building-card">
        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/monobrut/uploadFiles/<?= $building['base_img'] ?>">
        <p class="title"><?= $building['name'] ?></p>
        <p class="city"><?= $building['city'] ?></p>
        <a href="buildings/detail.php?id=<?= $building['idbuildings'] ?>">Information</a>

    </div>
<?php } ?>