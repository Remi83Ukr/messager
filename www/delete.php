<?php
require './database/connect.php';
require './database/db.php';
require 'path.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
    header('location: ' . BASE_URL . 'post.php');
}