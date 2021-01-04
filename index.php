<?php

// Session Start
session_start();

// Autoload
require_once 'autoload.php';

// Database
require_once 'config/database.php';

// Parameters
require_once 'config/parameters.php';

// Helpers
require_once 'helpers/helpers.php';

// Layout ( Header  +  Sidebar )
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

// Content
if (isset($_GET['controller'])) {
    $name_controller = $_GET['controller'] . "Controller";
} else if (!isset($name_controller) && !isset($_GET['action'])) {
    $name_controller = default_controller . "Controller";
} else {
    echo "<h1>404</h1>";
    echo "<hr/>";
    echo "<h3>Página no encontrada!</h3>";
}

if (class_exists($name_controller)) {
    $controller = new $name_controller();

    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    } else if (!isset($_GET['action'])) {
        $default_action = default_action;
        $controller->$default_action();
    } else {
        echo "<h1>404</h1>";
        echo "<hr/>";
        echo "<h3>Página no encontrada!</h3>";
    }
}

// Layout ( Footer )
require_once 'views/layout/footer.php';
?>
