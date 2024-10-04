<?php
require 'cookie_params.php';

session_start();
session_regenerate_id(true);

if (isset($_GET['reserve'])) {
    $_SESSION['cart'][$_GET['reserve']] += 1;
}
header('Location: index.php?reserve=' . urlencode($_GET['reserve']));
exit();
?>
