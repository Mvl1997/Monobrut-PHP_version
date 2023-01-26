<?php
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/header_dev.php';
include $_SERVER["DOCUMENT_ROOT"] . '/monobrut/shared/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'bad request method';
    exit(0);
}
//request variables
$email = filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_var($_POST["pwd"], FILTER_SANITIZE_SPECIAL_CHARS);

//TODO check password empty?
$email = strtolower($email);
$pathAdmin = "http://" . $_SERVER["HTTP_HOST"] . '/monobrut/admin/';
$pathLogin = "http://" . $_SERVER["HTTP_HOST"] . '/monobrut/login.php';

//errors
$errors = "?error=401"; //wrong user credentials

//sql
$sql = "SELECT iduser, username, password
  FROM users 
  WHERE username = :user AND password= MD5(:pwd)
  LIMIT 1";

//query db
$statement = $db_conn->prepare($sql);
$statement->bindParam(":user", $email);
$statement->bindParam(":pwd", $password);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

$num_rows = $statement->rowCount();

//create sessios if user exist and the right user credentials
if ($result && $num_rows > 0) {
    // Ja, het is de juiste
    $user = $result;

    session_start();
    session_regenerate_id();
    $_SESSION["loggedin"] = TRUE;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $user["username"];
    $_SESSION["id"] = $result["userid"];

    header("Location:" . $pathAdmin);
    exit;
} else {
    // Nee, login was fout
    header("Location:" . $pathLogin . $errors);
}
