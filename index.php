<?php
session_start();
require "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>
</head>
<body>

<a href="index.php">TestService</a>

<?php
if ($_SESSION['user']) {
    echo
        '<div>' .
            $_SESSION['user']['login'] .
            '<a href="core/handle_logout.php">Выйти</a>
        </div>';
} else {
    echo
        '<div>
            <a href="pages/login.php">Войти</a>
            <a href="pages/registration.php">Зарегестрироваться</a>
        </div>';
}
?>

<?php include "html_elements/message.php" ?>

<?php
if ($_SESSION['user']) {
    switch ($_SESSION['user']['role']) {
        case 0:
            echo '<a href="pages/admin.php">Панель администрирования</a>';
            break;
        case 1:
            echo '<a href="pages/student.php">Пройти тесты</a>';
            break;
        case 2:
            echo '<a href="pages/tutor.php">Управление моими тестами</a>';
            break;
    }
}
?>

</body>
</html>