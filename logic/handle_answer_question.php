<?php
session_start();
require_once '../includes/db.php';

$questNum = $_POST['questNum'];
$realAnswers = $_SESSION['testToSolve']['questions'][$questNum]['question']['answers'];
$userID = $_SESSION['user']['id'];
$testID = $_SESSION['testToSolve']['id'];
$questionID = $_SESSION['testToSolve']['questions'][$questNum]['question']['questionID'];
$answer = trim($_POST['answer']);

$realAnswers = explode(";", $realAnswers);
$isAnswerTrue = false;
foreach ($realAnswers as $realAnswer) {
    if (strcasecmp(trim($realAnswer), $answer) == 0) {
        $isAnswerTrue = true;
        break;
    }
}

mysqli_query(
    $connection,
    "INSERT INTO `answers` (`answerID`, `user`, `test`, `question`, `answer`, `mark`) 
    VALUES (NULL, '$userID', '$testID', '$questionID', '$answer', '$isAnswerTrue')"
);

$dbAnswer = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * 
    FROM `answers` 
    WHERE `user` = '$userID' AND `test` = '$testID' AND `question` = '$questionID'"
));

if ($dbAnswer) {
    $_SESSION['testToSolve']['questions'][$questNum]['state'] = 1;
    $_SESSION['testToSolve']['numOfStudentAnswers'] += 1;
    if ($_SESSION['testToSolve']['numOfStudentAnswers'] == $_SESSION['testToSolve']['numOfQuestions']) {
        header('Location: handle_finish_test.php');
    } else {
        header('Location: ../pages/solve_test.php');
    }
} else {
    $_SESSION['message'] = "Ответ на вопрос не сохранился, повторите попытку. 
    userID - $userID, testID - $testID, questID - $questionID, questNum - $questNum.";
    header('Location: ../pages/solve_test.php');
}