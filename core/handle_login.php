<?php
session_start();
require_once '../includes/db.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$result = mysqli_query(
    $connection,
    "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'"
);

$numOfRows = mysqli_num_rows($result);

if ($numOfRows == 0) {
    $_SESSION['message'] = "Неверный логин/пароль $password";
    header('Location: ../pages/login.php');
} elseif ($numOfRows > 1) {
    $_SESSION['message'] = 'Найдено больше одной записи с данным логином и паролем';
    header('Location: ../pages/login.php');
} else {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['message'] = "Добро пожаловать, $login";
    $_SESSION['user'] = [
        'id' => $user['userID'],
        'firstName' => $user['firstName'],
        'middleName' => $user['middleName'],
        'lastName' => $user['lastName'],
        'login' => $user['login'],
        'role' => $user['role']
    ];
    header('Location: ../index.php');
}