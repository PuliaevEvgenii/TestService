<?php
session_start();
if ($_SESSION['user']) {
    echo
        '<div>' .
            $_SESSION['user']['login'] .
            '<a href=\'core/handle_logout.php\'>Выйти</a>
        </div>';
} else {
    echo
        '<div>
            <a href="pages/login.php">Войти</a>
            <a href="pages/registration.php">Зарегестрироваться</a>
        </div>';
}