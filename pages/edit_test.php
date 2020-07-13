<?php
session_start();
include "../logic/handle_get_test_questions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новый тест</title>
</head>
<body>

<?php include "../html_elements/message.php" ?>

<b><?= $_SESSION['editTest']['name'] ?></b>

<div class="test-questions">
    <table>
        <caption>Вопросы теста</caption>
        <tr>
            <th>id</th>
            <th>Вопрос</th>
            <th>Варианты ответов</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo '
                <tr>
                    <td>' . $testQuestions[$i]['questionID'] . '</td>
                    <td>' . $testQuestions[$i]['name'] . '</td>
                    <td>' . $testQuestions[$i]['answers'] . '</td>
                </tr>
             ';
        }
        ?>
    </table>
</div>

<form method="post" action="../logic/handle_create_question.php">
    <label><input type="text" name="name" placeholder="Вопрос"></label>
    <label><input type="text" name="answers" placeholder="Варианты ответа"></label>
    <button type="submit" name="create-question">Добавить вопрос</button>
</form>

<form method="post" action="../logic/handle_end_test_edition.php">
    <button type="submit" name="end-test-edition">Закончить редактирование</button>
</form>

</body>
</html>