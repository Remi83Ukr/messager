<?php

require './database/connect.php';
require './database/db.php';
require 'path.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['id']) {
        $id = $_GET['id'];
        $_POST['id'] = $_GET['id'];
        $query = selectOne('posts', ['id' => $id]);
        $json = json_encode($query);
        echo $json;
    } else {
        echo 'something is wrong';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = trim($_POST['caption']);
    $content = trim($_POST['content']);
    $userID = $_SESSION['id'];
    $postID = trim($_POST['post_id']);
    if ($postID) {
        if ($caption === '' || $content === '') {
            echo "Empty fields exist";
        } else {
            $existence = updatePost('posts', $postID, array("user_id" => $userID, "caption" => $caption, "content" => $content));
            header('location: ' . BASE_URL . 'post.php');
        }
    }
}
