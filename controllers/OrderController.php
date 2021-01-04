<?php

class orderController {

    function index() {
        require_once 'views/order/make_order.php';
    }
    
    function manage_orders() {
        echo "hola";
    }

    function add_order() {
        if (isset($_SESSION['LOGIN']['USER']) && isset($_POST)) {
            $errors = [];
            $id_user = $_SESSION['LOGIN']['USER']['id'];
            $province = isset($_POST['province']) ? $_POST['province'] : null;
            $locality = isset($_POST['locality']) ? $_POST['locality'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;

            // Validations
            if (is_numeric($id_user)) {
                $validate_id_user = true;
            } else {
                $validate_id_user = false;
                $errors['id_user'] = "¡Id_usuario no válido!";
            }

            if (!is_numeric($province) && !preg_match("/[0-9]/", $province)) {
                $validate_province = true;
            } else {
                $validate_province = false;
                $errors['province'] = "¡Formato incorrecto!";
            }

            if (!is_numeric($locality) && !preg_match("/[0-9]/", $locality)) {
                $validate_locality = true;
            } else {
                $validate_locality = false;
                $errors['locality'] = "¡Formato incorrecto!";
            }

            if (!is_numeric($address)) {
                $validate_locality = true;
            } else {
                $validate_locality = false;
                $errors['locality'] = "¡Formato incorrecto!";
            }

            // Database
            if (count($errors) == 0) {
                require_once 'models/order.php';
                $order_object = new Order();
                $order_object->setId_user($id_user);
                $order_object->setProvince($province);
                $order_object->setLocation($locality);
                $order_object->setAddress($address);
                $total_price = 0;
                foreach ($_SESSION['CART']['ADD'] as $index => $cart) {
                    $total_price += $cart['price'];
                }
                $order_object->setCost($total_price);

                // Query
                $query = $order_object->saveOrder($order_object);

                // Si se realiza el insert del pedido ->
                if ($query) {
                    // Recojo el id de el último insert de pedido
                    $last_order_id = $order_object->getLastOrderId();
                    if ($last_order_id) {
                        $last_order_object = mysqli_fetch_assoc($last_order_id);
                        // Y lo guardo en $order_id
                        $order_id = $last_order_object['order_id'];

                        require_once 'models/orderline.php';
                        $orderline_object = new Orderline();
                        foreach ($_SESSION['CART']['ADD'] as $index => $product) {
                            $orderline_object->setOrder_id($order_id);
                            $orderline_object->setProduct_id($product['id']);
                            $orderline_object->setUnits($product['units']);

                            // Query SAVEORDERLINE
                            $orderline_object->saveOrderLine($orderline_object);
                        }
                        $_SESSION['ORDER']['SAVE']['TRUE'] = "¡Pedido realizado con éxito!";
                        header("Location: " . base_url . "orderline/index");
                    }
                } else {
                    $_SESSION['ORDER']['SAVE']['FALSE'] = "¡Error del servidor!";
                    header("Location: " . base_url);
                }
            } else {
                $_SESSION['ORDER']['SAVE']['ERROR'] = $errors;
                header("Location: " . base_url . "order/index");
            }
        }
    }

    function my_orders() {
        // Unset Cart
        if (isset($_SESSION['CART'])) {
            unset($_SESSION['CART']);
        }
        // Database
        require_once 'models/order.php';
        $order_object = new Order();
        $all_orders = $order_object->getOrdersByUserId($_SESSION['LOGIN']['USER']['id']);

        // View My Orders
        require_once 'views/order/my_orders.php';
    }
    
    function detail() {
        if (isset($_GET['id'])) {
            $id_order = $_GET['id'];
            
            // Database
            require_once 'models/order.php';
            require_once 'models/product.php';
            require_once 'models/orderline.php';
            $order_object = new Order();
            $product_object = new Product();
            $orderline_object = new Orderline();
            $order_detail = $order_object->getOrderById($id_order);
            $order = mysqli_fetch_assoc($order_detail);
            $orderline_detail = $orderline_object->getOrderlineByOrderId($id_order);
            
            require_once 'views/order/order_detail.php';
        }
    }

}

?>