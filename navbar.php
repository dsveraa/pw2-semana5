<?php
require 'cookie_params.php';

session_start();
session_regenerate_id(true);

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<div class="bg-body-tertiary">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-secodary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-danger" id="count-label"><?php
                                if (isset($_GET['search'])) {
                                    echo '+1';
                                }
                                ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-2" id="notificationDropdown" aria-labelledby="notificationDropdown">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
                                if (isset($_GET['search'])) {
                                    $suggestion = add_suggestions($packages, $date, $nights, $destination);
                                    echo '¿Qué tal unas vacaciones alojando en el hotel <b>'. $suggestion->hotel . '</b> por <b>'. $nights .' noches</b> en la ciudad de <b>' . $suggestion->city . '</b>?';
                                } else {
                                    echo 'Sin notificaciones';
                                }
                            } else {
                                echo 'Sin notificaciones';
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if ($cart_count > 0): ?>
                                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-success">
                                    <?php echo $cart_count; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-2" id="notificationDropdown" aria-labelledby="notificationDropdown">
                            <?php require 'cart.php'; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
