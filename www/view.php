<?php
require './database/connect.php';
require './database/db.php';
require 'path.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['guest_id'])) {
    if ($_SESSION['id'] === $_GET['guest_id']) {
        unset($_SESSION['guest_id']);
    } else {
        $_SESSION['guest_id'] = $_GET['guest_id'];
    }
    header('location: ' . BASE_URL . 'post.php');
}