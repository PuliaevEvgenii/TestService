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
<?php include "html_elements/header.php" ?>

<?php
if ($_SESSION['message']) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
}
unset($_SESSION['message']);
?>

</body>
</html>