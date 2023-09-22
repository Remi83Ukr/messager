<?php
session_start();

require 'path.php';

unset($_SESSION['id']);
unset($_SESSION['login']);
unset($_SESSION['guest_id']);

header('location: ' . BASE_URL);