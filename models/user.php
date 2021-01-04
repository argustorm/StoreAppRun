<?php

class User {

    private $name;
    private $surnames;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $db;

    function __construct() {
        $this->db = Database::GetConnection();
    }

    function getName() {
        return $this->name;
    }

    function getSurnames() {
        return $this->surnames;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function getImage() {
        return $this->image;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setSurnames($surnames): void {
        $this->surnames = $surnames;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

    function setImage($image): void {
        $this->image = $image;
    }

    function saveUser($user) {
        $query = $this->db->query("INSERT INTO tienda.users
                        (name, surnames, email, password, rol, image)
                        VALUES('$user->name', 
			       '$user->surnames', 
			       '$user->email', 
                               '$user->password', 
				NULL, 
				NULL);");
        
        if ($query) {
            return $query;
        } else {
            echo '<p>¡Error al ejecutar la consulta!</p>';
        }
    }
    
    function loginUser($email) {
        $query = $this->db->query("select * from users where email = '$email'");
        if ($query) {
            return $query;
        } else {
            echo '<p>¡Error al ejecutar la consulta!</p>';
        }
    }

}
