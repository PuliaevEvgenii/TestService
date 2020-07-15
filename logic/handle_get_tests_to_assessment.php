<?php
session_start();
require_once '../includes/db.php';

function findMark($userID, $testID, $marks)
{
    $result = "";
    foreach ($marks as $mark) {
        if ($mark['user'] == $userID && $mark['test'] == $testID) {
            $result = $mark['mark'];
        }
    }
    return $result;
}

$owner = $_SESSION['user']['id'];

$dbMarks = mysqli_query(
    $connection,
    "SELECT m.user, m.test, m.mark 
    FROM `marks` m INNER JOIN `tests` t 
    WHERE m.test = t.testID AND t.owner = '$owner'"
);

$numOfMarks = mysqli_num_rows($dbMarks);
$marks = array();
for ($i = 0; $i < $numOfMarks; ++$i) {
    $marks[$i] = mysqli_fetch_assoc($dbMarks);
}

$dbSolvedTests = mysqli_query(
    $connection,
    "SELECT u.userID, u.lastName, u.firstName, u.middleName, u.login, t.testID, t.name, st.true_answers, st.false_answers 
    FROM `solved_tests` st INNER JOIN `users` u, `tests` t 
    WHERE st.user = u.userID AND st.test = t.testID AND t.owner = '$owner'"
);

$numOfSolvedTests = mysqli_num_rows($dbSolvedTests);
$solvedTests = array();
for ($i = 0; $i < $numOfSolvedTests; ++$i) {
    $solvedTests[$i] = mysqli_fetch_assoc($dbSolvedTests);
    $solvedTests[$i]['mark'] = findMark($solvedTests[$i]['userID'], $solvedTests[$i]['testID'], $marks);
}