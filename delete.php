<?php

include('dbcon.php');
include('check.php');

if (is_login()) {

    if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin'] == 1);
    else
        header("Location: welcome.php");
} else
    header("Location: index.php");


if (isset($_GET['del_id'])) {
    $stmt = $con->prepare('DELETE FROM users WHERE username =:del_id');
    $stmt->bindParam(':del_id', $_GET['del_id']);
    $stmt->execute();
}

header("Location: admin.php");
