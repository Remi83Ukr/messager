<?php

require './database/connect.php';
include './database/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $pass = ($_POST['pass']);

    if ($login === '' || $pass === '') {
        echo "Empty fields exist";
    } else {
        $existence = selectOne('customers', ['login' => $login]);
        if ($existence && $pass === $existence['password']) {
            echo 'Success';
            $_SESSION['id'] = $existence['id'];
            $_SESSION['login'] = $existence['login'];
            $_SESSION['guest_id'] = $_SESSION['id'];
        } else {
            echo 'Аuthorization error';
        }
    }
} else {
    $login = '';
}
