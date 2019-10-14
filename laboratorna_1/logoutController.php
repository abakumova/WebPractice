<?php
$mainPage = '../index.php';
session_start();
session_destroy();
header('Location: ' . $mainPage);