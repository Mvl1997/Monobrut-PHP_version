<?php
//include server header
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/auth/secure.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';
//function
//this function has no security and no error handling, this is for testing.
function uploadImg($dir)
{
    $fileName = $_FILES["img_src"]["name"];
    $targetFile = $dir . basename($_FILES["img_src"]["name"]);

    if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $targetFile)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//save to database
function saveToDb($data, $conn)
{
    //print_r($data);
    $datum = date('Y-m-d H:i:s');
    $sql = "INSERT INTO buildings (name,b_desc,city,date_created,base_img) VALUES (:name,:descr,:city,:datum,:img)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':name', $data['bname']);
    $statement->bindParam(':descr', $data['desc']);
    $statement->bindParam(':city', $data['city']);
    $statement->bindParam(':datum', $datum);
    $statement->bindParam(':img', $data['img_name']);

    $bool = $statement->execute();
    return ($bool);
}

//server variables
$buildings = array();
$buildings['bname'] = filter_var($_POST["b_name"], FILTER_SANITIZE_SPECIAL_CHARS);
$buildings['desc'] = filter_var($_POST["desc"], FILTER_SANITIZE_SPECIAL_CHARS);
$buildings['city'] = filter_var($_POST["city"], FILTER_SANITIZE_SPECIAL_CHARS);
$buildings['img_name'] = NULL;
$imgUploaded = FALSE;

//print_r($buildings);
//path redirect
$pathReturn = "http://" . $_SERVER["HTTP_HOST"] . '/monobrut/admin/buildings/index.php';
$uploadDirectory = $_SERVER["DOCUMENT_ROOT"] . '/monobrut/uploadFiles/';
//print_r($_FILES);

//message codes
//1 succes toegevoegd
//2 error uploading failed


if ($_FILES["img_src"]["name"] == "") {
    echo "no image uploaded.";
} else {
    $imgUploaded = TRUE;
    $buildings['img_name'] = $_FILES["img_src"]["name"];
}

if ($imgUploaded) {
    $bool = move_uploaded_file($_FILES["img_src"]["tmp_name"], $uploadDirectory . $buildings['img_name']);
    $isSaved = saveToDb($buildings, $db_conn);
} else {
    $isSaved = saveToDb($buildings, $db_conn);
}
if ($isSaved) {
    echo "Building saved to databank";
    header("Location:" . $pathReturn  . "?code=1");
} else {
    header("Location:" . $pathReturn  . "?code=2");
}
