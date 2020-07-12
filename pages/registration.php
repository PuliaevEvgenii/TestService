<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<form method="post" action="../core/handle_registration.php">
    <label>
        <input type="text" name="lastName" placeholder="Фамилия">
    </label>
    <label>
        <input type="text" name="firstName" placeholder="Имя">
    </label>
    <label>
        <input type="text" name="middleName" placeholder="Отчество">
    </label>
    <label>
        <input type="text" name="login" placeholder="Логин">
    </label>
    <label>
        <input type="password" name="password" placeholder="Пароль">
    </label>
    <label>
        <input type="password" name="confirmPassword" placeholder="Подтвердите пароль">
    </label>
    <button type="submit" name="loginButton">Зарегестрироваться</button>
</form>

<p class="auth-redirect">Уже есть аккаунт? - <a href="registration.php">Войдите</a>!</p>

<?php
if ($_SESSION['message']) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
}
unset($_SESSION['message']);
?>

</body>
</html>