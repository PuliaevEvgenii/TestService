<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
</head>
<body>
<form method="post" action="../core/handle_login.php">
    <label>
        <input type="text" name="login" placeholder="Логин">
    </label>
    <label>
        <input type="password" name="password" placeholder="Пароль">
    </label>
    <button type="submit" name="login-button">Войти</button>
</form>

<p class="auth-redirect">Нет аккаунта? - <a href="registration.php">Зарегестрируйтесь</a>!</p>

<?php include "../html_elements/message.php" ?>

</body>
</html>