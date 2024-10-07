<?php
require 'cookie_params.php';

session_start();
session_regenerate_id(true);

if (empty($_SESSION['cart'])) {
    echo "El carrito está vacío<br>";
} else {
    echo "Carrito:";
    foreach ($_SESSION['cart'] as $pkg_name => $name) {
        echo "<hr>";
        echo "<div class='cart-style'>";
        echo    "<div>";
        echo        htmlspecialchars($pkg_name);
        echo    "</div>";
        echo    "<div>";
        echo        "<a href='delete.php?reserve=" . urlencode($pkg_name) . "'><i class='fas fa-trash'></i></a>";
        echo    "</div>";
        echo "</div>";
    }
    echo '<br><a class="btn btn-danger" href="delete.php?cart=remove_all">Vaciar carrito</a>';
}
?>
