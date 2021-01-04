<?php

class orderlineController {

    function index() {
        if (isset($_SESSION['LOGIN']['USER'])) {
            $id_user = $_SESSION['LOGIN']['USER']['id'];
            
            // Database
            require_once 'models/product.php';
            require_once 'models/orderline.php';
            $product_object = new Product();
            $orderline_object = new Orderline();
            $orderline_result = $orderline_object->orderLineDetail($id_user);
            
            // Detail View
            require_once 'views/orderline/orderline_detail.php';
        }
    }

}
