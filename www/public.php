<?php

require './database/connect.php';
require './database/db.php';
require 'path.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = trim($_POST['caption']);
    $content = trim($_POST['content']);
    $userID = $_SESSION['id'];
    if ($caption === '' || $content === '') {
        echo "Empty fields exist";
    } else {
        $existence = insert('posts', array("`user_id`" => $userID, "`caption`" => $caption, "`content`" => $content));
            header('location: ' . BASE_URL . 'post.php');
    }
} else {
    echo 'Get';
}