<?php
ini_set('display_errors', 1);
error_reporting(E_ALL); include 'menus.php';

session_start();
unset($_SESSION);
session_destroy();
if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
    header('Location: ../index.php');
else
    header('Location: index.php');
?>