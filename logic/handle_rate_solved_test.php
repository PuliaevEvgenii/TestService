<?php
session_start();
require_once '../includes/db.php';

$userID = $_POST['user'];
$testID = $_POST['test'];
$mark = $_POST['mark'];

$dbMark = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `marks` WHERE `user` = '$userID' AND `test` = '$testID'"
));

if ($dbMark) {
    $markID = $dbMark['markID'];
    mysqli_query(
        $connection,
        "UPDATE `marks` 
         SET 
            `markID` = '$markID', 
            `user` = '$userID', 
            `test` = '$testID', 
            `mark` = '$mark' 
         WHERE `user` = '$userID' AND `test` = '$testID'"
    );

    $dbMark = mysqli_fetch_assoc(mysqli_query(
        $connection,
        "SELECT * FROM `marks` WHERE `user` = '$userID' AND `test` = '$testID' AND `mark` = '$mark'"
    ));

    if ($dbMark) {
        $_SESSION['message'] = "Оценка успешно изменена.";
        header('Location: ../pages/tutor.php');
    } else {
        $_SESSION['message'] = "Оценка не изменена.";
        header('Location: ../pages/tutor.php');
    }
} else {
    mysqli_query(
        $connection,
        "INSERT INTO `marks` (`markID`, `user`, `test`, `mark`) 
    VALUES (NULL, '$userID', '$testID', '$mark')"
    );

    $dbMark = mysqli_fetch_assoc(mysqli_query(
        $connection,
        "SELECT * FROM `marks` WHERE `user` = '$userID' AND `test` = '$testID' AND `mark` = '$mark'"
    ));

    if ($dbMark) {
        $_SESSION['message'] = "Оценка успешно добавлена.";
        header('Location: ../pages/tutor.php');
    } else {
        $_SESSION['message'] = "Оценка не добавлена.";
        header('Location: ../pages/tutor.php');
    }
}