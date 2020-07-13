<?php
session_start();
include "../logic/handle_get_tutors_tests.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет преподователя</title>
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="tutors-tests">
    <table>
        <caption>Ваши тесты</caption>
        <tr>
            <th>id</th>
            <th>Название</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo '
                <tr>
                    <td>' . $allTests[$i]['testID'] . '</td>
                    <td>' . $allTests[$i]['name'] . '</td>
                </tr>
             ';
        }
        ?>
    </table>
</div>

<form method="post" action="../logic/handle_create_test.php">
    <label><input type="text" name="name" placeholder="Название теста"></label>
    <button type="submit" name="create-test">Создать тест</button>
</form>

</body>
</html>
