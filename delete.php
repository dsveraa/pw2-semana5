<?php
require 'cookie_params.php';

session_start();

session_regenerate_id(true);

if (isset($_GET['reserve'])) {
    if (isset($_SESSION['cart'][$_GET['reserve']])) {
        unset($_SESSION['cart'][$_GET['reserve']]);
    }
}

if (isset($_GET['cart']) && $_GET['cart'] === 'remove_all') {
    unset($_SESSION['cart']); 
    session_unset();
    session_destroy();
}

header('Location: index.php');
exit();
?>
