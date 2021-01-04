<?php

class Category {

    private $id;
    private $name;
    private $db;

    function __construct() {
        $this->db = Database::GetConnection();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function getAllCategories() {
        $query = $this->db->query("select * from category");

        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from category'</p>";
        }
    }

    function newCategory($category) {
        $query = $this->db->query("INSERT INTO category
                                    (name)
                                    VALUES('$category->name');");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from category'</p>";
        }
    }
    
    function deleteCategory($id_category) {
        $query = $this->db->query("DELETE FROM tienda.category
                                    WHERE id=$id_category;
                                    ");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from category'</p>";
        }
    }
    
    function getCategoryById($id_category) {
        $query = $this->db->query("select * from category where id = $id_category");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from category'</p>";
        }
    }
    
    function editCategory($id_category,$name_category) {
        $query = $this->db->query("UPDATE category
                                    SET name='$name_category'
                                    WHERE id=$id_category;");
        if ($query) {
            return $query;
        } else {
            return "<p>Error al realizar la consulta SQL: 'select * from category'</p>";
        }
    }
}
?>

