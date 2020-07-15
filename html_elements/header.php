<?php
session_start();

echo '<a href="../index.php">TestService</a>';
echo '
    <div>' .
        $_SESSION['user']['login'] .
        '<a href="../core/handle_logout.php">Выйти</a>
    </div>
';