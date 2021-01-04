<?php

class cartController {

    function index() {
        if (isset($_SESSION['CART']['ADD'])) {
            $product_array = $_SESSION['CART']['ADD'];
            require_once 'views/cart/manage_cart.php';
        } else {
            require_once 'views/cart/empty_cart.php';
        }
    }

    function add() {
        if (isset($_GET['id']) && isset($_POST['units'])) {
            $id_product = isset($_GET['id']) ? $_GET['id'] : null;
            $units = isset($_POST['units']) ? $_POST['units'] : null;

            // Database
            require_once 'models/product.php';
            $product_object = new Product();
            $product_info = $product_object->getProductById($id_product);
            $product = mysqli_fetch_assoc($product_info);


            /* Nota: Quizas sea aquí donde multiplique el precio del producto por las unidades seleccionadas. */
            // Añado un nuevo producto
            if (!isset($_SESSION['CART']['ADD'])) {
                if (is_object($product_object)) {
                    $_SESSION['CART']['ADD'][] = array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'units' => $units,
                        'image' => $product['image'],
                        'price' => $product['price'] * $units
                    );
                    $_SESSION['CART']['ADD']['NEW'] = "¡Producto añadido al carrito!";
                    header("Location: " . base_url . "cart/index");
                }
            } else if (isset($_SESSION['CART']['ADD'])) {
                // Añado otro producto
                if (is_object($product_object)) {
                    $_SESSION['CART']['ADD'][] = array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'units' => $units,
                        'image' => $product['image'],
                        'price' => $product['price'] * $units
                    );
                    $_SESSION['CART']['ADD']['NEW'] = "¡Producto añadido al carrito!";

                    header("Location: " . base_url . "cart/index");
                }
            }
        }
    }

    function remove_all() {
        if (isset($_SESSION['CART'])) {
            unset($_SESSION['CART']);
        }
        header("Location: " . base_url . "cart/index");
    }

}
?>

