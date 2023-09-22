<?php
require './database/connect.php';
require './database/db.php';

if (isset($_SESSION['id'])) {
    $queryPost = selectAll('posts', ['user_id' => $_SESSION['id']]);
}