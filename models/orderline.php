<?php
    class Orderline {
        private $order_id;
        private $product_id;
        private $units;
        private $db;
        
        function __construct() {
            $this->db = Database::GetConnection();
        }
        
        function getOrder_id() {
            return $this->order_id;
        }

        function getProduct_id() {
            return $this->product_id;
        }

        function getUnits() {
            return $this->units;
        }

        function setOrder_id($order_id): void {
            $this->order_id = $order_id;
        }

        function setProduct_id($product_id): void {
            $this->product_id = $product_id;
        }

        function setUnits($units): void {
            $this->units = $units;
        }

        function saveOrderLine($orderline) {
            $query = $this->db->query("INSERT INTO orderlines
                                (order_id, product_id, units)
                                    VALUES($orderline->order_id, 
                                                $orderline->product_id, 
                                                        $orderline->units);");
            if ($query) {
                return $query;
            } else {
                return "<p>Error al realizar la consulta SQL</p>";
            }
        }
        
        function orderLineDetail($id_user) {
            $query = $this->db->query("select Orderlines.order_id , Orderlines.units , Orderlines.product_id , order.user_id 
                                        from orderlines
                                        inner join `order` on orderlines.order_id = `order`.id
                                        where `order`.user_id = $id_user;");
            if ($query) {
                return $query;
            } else {
                return "<p>Error al realizar la consulta SQL</p>";
            }
        }
        
        function getOrderlineByOrderId($order_id) {
            $query = $this->db->query("select * from orderlines where order_id = $order_id;");
            if ($query) {
                return $query;
            } else {
                return "<p>Error al realizar la consulta SQL</p>";
            }
        }

    }
?>
