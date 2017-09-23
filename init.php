<?php
$connect = mysqli_connect('localhost', 'root', '', 'doingsdone');
if (!$connect) {
    $error = renderTemplate('templates/error.php', ['error' => mysqli_connect_error()]);
    print($error);
    exit();
}
?>
