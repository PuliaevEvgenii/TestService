<?php
session_start();
require_once '../includes/db.php';

$login = $_SESSION['foundUser']['login'];
$password = md5($_POST['password']);
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$role = $_POST['role'];


mysqli_query(
    $connection,
    "UPDATE `users` 
    SET 
        `userID`=NULL, 
        `firstName`='$firstName', 
        `middleName`='$middleName', 
        `lastName`='$lastName', 
        `login`='$login', 
        `password`='$password', 
        `role`='$role' 
    WHERE `login`='$login'"
);

$user = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'"
));

if ($user) {
    $_SESSION['message'] = 'Редактирование прошло успешно';
} else {
    $_SESSION['message'] = 'Что то пошло не так...';
}
header('Location: ../pages/admin.php');