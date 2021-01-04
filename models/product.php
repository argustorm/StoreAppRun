<?php

class Product {

    private $id_category;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $offer; // Puede ser NULL
    private $date; // Curdate()
    private $image;
    private $db;

    function __construct() {
        $this->db = Database::GetConnection();
    }

    function getId_category() {
        return $this->id_category;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }

    function getStock() {
        return $this->stock;
    }

    function getOffer() {
        return $this->offer;
    }

    function getDate() {
        return $this->date;
    }

    function getImage() {
        return $this->image;
    }

    function setId_category($id_category): void {
        $this->id_category = $id_category;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setPrice($price): void {
        $this->price = $price;
    }

    function setStock($stock): void {
        $this->stock = $stock;
    }

    function setOffer($offer): void {
        $this->offer = $offer;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setImage($image): void {
        $this->image = $image;
    }

    function getAllProducts() {
        $query = $this->db->query("select * from products;");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from products'</p>";
        }
    }

    function saveProduct($product) {
        $query = $this->db->query("INSERT INTO products
                                (category_id, name, description, price, stock, offer, `date`, image)
                                VALUES($product->id_category, '$product->name', '$product->description', $product->price, $product->stock, NULL, curdate(), '$product->image');");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }

    function getProductById($id_product) {
        $query = $this->db->query("select * from products where id = $id_product;");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }

    function editProduct($id_product, $product) {
        $query = $this->db->query("UPDATE products
                                    SET category_id=$product->id_category, 
                                               name='$product->name', 
                                        description='$product->description', 
                                              price=$product->price, 
                                              stock=$product->stock, 
                                              offer=NULL, `date`=curdate(), 
                                              image='$product->image'
                                    WHERE id=$id_product;");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL</p>";
        }
    }
    
    function deleteProduct($id_product) {
       $query = $this->db->query("DELETE FROM products
                                    WHERE id=$id_product;"); 
       if ($query) {
           return $query;
       } else {
           return "<p>Error al realizar la consulta SQL</p>";
       }
    }

}
