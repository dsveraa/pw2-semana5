<?php
require 'cookie_params.php';

session_start();
session_regenerate_id(true);

require 'classes.php'; 
require 'functions.php';

$json_data = file_get_contents('reservations.json');
$packages = json_decode($json_data, true);

$origin = $destination = $date = $nights = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
    if (isset($_GET['search'])) {
        $origin = isset($_GET['origin']) ? $_GET['origin'] : null;
        $destination = isset($_GET['destination']) ? $_GET['destination'] : null;
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $nights = isset($_GET['nights']) ? $_GET['nights'] : null;
    }
}

require 'head.php';
?>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container my-5">
        <?php if (!isset($_GET['search'])): ?>
            <h1>Buscar y reservar vuelos y hoteles</h1>
            <h5 class="text-primary">Santiago, Buenos Aires, Lima o Miami entre el 01 hasta el 05 de octubre.</h5>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="my-5">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="origin" class="form-label">Origen:</label>
                    <select id="origin" name="origin" class="form-select" required>
                        <option value="" disabled selected>Selecciona una ciudad</option>
                        <option value="Santiago">Santiago</option>
                        <option value="Lima">Lima</option>
                        <option value="Buenos Aires">Buenos Aires</option>
                        <option value="Miami">Miami</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="destination" class="form-label">Destino:</label>
                    <select id="destination" name="destination" class="form-select" required>
                        <option value="" disabled selected>Selecciona una ciudad</option>
                        <option value="Santiago">Santiago</option>
                        <option value="Lima">Lima</option>
                        <option value="Buenos Aires">Buenos Aires</option>
                        <option value="Miami">Miami</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date" class="form-label">Fecha:</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="nights" class="form-label">Noches de hotel:</label>
                    <select id="nights" name="nights" class="form-select" required>
                        <option value="" disabled selected>Selecciona noches</option>
                        <?php
                        for ($i = 1; $i <= 7; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" name="search" class="btn btn-primary">Buscar</button>
        </form>
        <?php endif; ?>
        <div id="search-results" class="my-3">
            <?php
            if (isset($_GET['search'])) {
                $new_package = compare_info($packages, $origin, $destination, $date, $nights);

                echo '<h1>Resultado de la búsqueda</h1>';

                if (!empty($new_package)) {
                    $new_package->show_info();
                    $pkg_string = new_pkg_string($new_package);
                ?>
                    <a href="add.php?reserve=<?php echo urlencode($pkg_string); ?>" class="btn btn-success my-2">Agregar al carrito</a>

                <?php
                } else {
                    echo '<h4 class="text-danger">No se encontraron coincidencias.</h4>';
                }
            } else if (isset($_GET['reserve'])) {
                echo '<h4 class="text-success">' . $_GET['reserve'] . ' ha sido agregado al carrito.</h4>';
            }
            
            ?>
            
        </div>
    </div>
</body>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
<script src="./script.js"></script>
</html>
