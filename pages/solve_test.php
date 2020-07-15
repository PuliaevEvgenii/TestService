<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест <?= $_SESSION['testToSolve']['name'] ?></title>
</head>
<body>

<?php include "../html_elements/message.php" ?>

<?php
for ($i = 0; $i < $_SESSION['testToSolve']['numOfQuestions']; ++$i) {
    if ($_SESSION['testToSolve']['questions'][$i]['state'] == 0) {
        echo '
            <form method="post" action="../logic/handle_answer_question.php">
                <label><input type="text" name="questNum" value="' . $i . '" hidden></label>
                <p>' . $_SESSION['testToSolve']['questions'][$i]['question']['name'] . '</p>
                <label><input type="text" name="answer" placeholder="Ваш ответ"></label>
                <button type="submit" name="answer-question">Сохранить</button>
            </form>
        ';
    }
}
?>

<form method="post" action="../logic/handle_finish_test.php">
    <button type="submit" name="finish-test">Завершить тест</button>
</form>

</body>
</html>