<?php

class Order {

    private $id_user;
    private $province;
    private $location;
    private $address;
    private $cost;
    private $state;
    private $date;
    private $time;
    private $db;

    function __construct() {
        $this->db = Database::GetConnection();
    }

    function getId_user() {
        return $this->id_user;
    }

    function getProvince() {
        return $this->province;
    }

    function getLocation() {
        return $this->location;
    }

    function getAddress() {
        return $this->address;
    }

    function getCost() {
        return $this->cost;
    }

    function getState() {
        return $this->state;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function setId_user($id_user): void {
        $this->id_user = $id_user;
    }

    function setProvince($province): void {
        $this->province = $province;
    }

    function setLocation($location): void {
        $this->location = $location;
    }

    function setAddress($address): void {
        $this->address = $address;
    }

    function setCost($cost): void {
        $this->cost = $cost;
    }

    function setState($state): void {
        $this->state = $state;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setTime($time): void {
        $this->time = $time;
    }

    function saveOrder($order) {
        $query = $this->db->query("INSERT INTO tienda.`order`
            (user_id, province, location, address, cost, state, `date`, `time`)
             VALUES($order->id_user, 
                             '$order->province', 
                             '$order->location', 
                             '$order->address', 
                             $order->cost, 
                             'confirm', 
                             curdate(), 
                             NULL);");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }
    
    function getLastOrderId() {
        $query = $this->db->query("select last_insert_id() as 'order_id';");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }
    
    function getOrdersByUserId($id_user) {
        $query = $this->db->query("select * from `order` where user_id = $id_user;");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }
    
    function getOrderById($order_id) {
        $query = $this->db->query("select * from `order` where id = $order_id;");
        if ($query) {
            return $query;
        } else {
             return "<p>Error al realizar la consulta SQL</p>";
        }
    }
    
    

}
