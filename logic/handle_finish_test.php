<?php
session_start();
require_once '../includes/db.php';

$userID = $_SESSION['user']['id'];
$testID = $_SESSION['testToSolve']['id'];

$dbAnswers = mysqli_query(
    $connection,
    "SELECT * FROM `answers` WHERE `user` = '$userID' AND `test` = '$testID'"
);

$numOfRows = mysqli_num_rows($dbAnswers);
$answers = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $answers[$i] = mysqli_fetch_assoc($dbAnswers);
}

$trueAnswersNum = 0;
foreach ($answers as $answer) {
    if ($answer['mark']) {
        $trueAnswersNum++;
    }
}
$falseAnswersNum = $numOfRows - $trueAnswersNum;

mysqli_query(
    $connection,
    "INSERT INTO `solved_tests` (`solved_test_id`, `user`, `test`, `true_answers`, `false_answers`) 
    VALUES (NULL, '$userID', '$testID', '$trueAnswersNum', '$falseAnswersNum')"
);

unset($_SESSION['testToSolve']);
header('Location: ../pages/student.php');