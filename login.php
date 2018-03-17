<?php
ob_start();
session_start();
require_once 'includes/connect.php';
if(isset($_SESSION["name"])){
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $query = $con->prepare('SELECT * FROM users Where username = ? and password = ?');
    $query->execute(array(sha1($name), sha1($password)));
    $count = $query->rowCount();
    if ($count > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin'] = intval($row['admin']);
        $_SESSION['name'] = ucfirst($row['name']);
    }
    print_r($row);
    print_r($_SESSION);
}
header("Location: index.php");
ob_end_flush();
exit();
?>