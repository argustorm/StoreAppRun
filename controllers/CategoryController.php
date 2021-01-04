<?php

class categoryController {

    function index() {
        
    }

    function manage_category() {
        require_once 'views/category/manage_category.php';
    }

    function new_category() {
        require_once 'views/category/new_category.php';
    }

    function save() {
        if (isset($_POST['name'])) {
            $errors = [];
            $name = $_POST['name'];

            // Validation
            if (!is_numeric($name)) {
                $validate_name = true;
            } else {
                $validate_name = false;
                $errors['name'] = "¡Formato incorrecto, ingrese caracteres!";
            }

            // Database
            if (count($errors) == 0) {
                require_once 'models/category.php';
                $category_object = new Category();
                $category_object->setName($name);
                $query = $category_object->newCategory($category_object);

                if ($query) {
                    $_SESSION['CATEGORY']['SAVED'] = "¡Categoria creada con éxito!";
                    header("Location: " . base_url . "category/manage_category");
                } else {
                    $_SESSION['CATEGORY']['UNSAVED'] = "¡Error al crear la categoria!";
                    header("Location: " . base_url . "category/new_category");
                }
            } else {
                $_SESSION['CATEGORY']['ERROR'] = $errors;
                header("Location: " . base_url . "category/new_category");
            }
        }
    }

    function delete() {
        if (isset($_GET['id'])) {
            $id_category = $_GET['id'];
            $errors = [];

            // Validation 
            if (is_numeric($id_category)) {
                $validate_id = true;
            } else {
                $validate_id = false;
                $errors['id'] = "¡Parámetro 'Id' erróneo!";
            }

            // Database
            if (count($errors) == 0) {
                require_once 'models/product.php';
                require_once 'models/category.php';
                $product_object = new Product();
                $category_object = new Category();
                $all_products = $product_object->getAllProducts();
                while ($product = mysqli_fetch_assoc($all_products)) {
                    if ($product['category_id'] == $id_category) {
                        $_SESSION['CATEGORY']['INDELIBLE'] = "¡Debe eliminar previamente los productos asociados a esta categoria!";
                        header("Location: " . base_url . "category/manage_category");
                    } else {
                        $query = $category_object->deleteCategory($id_category);

                        if ($query) {
                            $_SESSION['CATEGORY']['DELETE'] = "¡Categoria borrada con éxito!";
                            header("Location: " . base_url . "category/manage_category");
                        } else {
                            $_SESSION['CATEGORY']['UNDELETE'] = "¡Error al borrar la categoria!";
                            header("Location: " . base_url . "category/manage_category");
                        }
                    }
                }
            } else {
                $_SESSION['CATEGORY']['DELETE']['ERROR'] = $errors;
                header("Location: " . base_url . "category/manage_category");
            }
        }
    }

    function edit() {
        if (isset($_GET['id'])) {
            $id_category = $_GET['id'];
            require_once 'models/category.php';
            $category_object = new Category();
            $query = $category_object->getCategoryById($id_category);

            // Almaceno contenido de la consulta en la variable $category
            $category = mysqli_fetch_object($query);
            require_once 'views/category/edit_category.php';
        }
    }

    function edit_saved() {
        if (isset($_GET['id'])) {
            if (isset($_POST['name'])) {
                $id_category = $_GET['id'];
                $name_category = $_POST['name'];
                echo "$id_category $name_category";
                // Validation 
                if (is_numeric($id_category)) {
                    $validate_id = true;
                } else {
                    $validate_id = false;
                    $errors['id'] = "¡Parámetro 'Id' erróneo!";
                }

                if (!is_numeric($name_category)) {
                    $validate_name = true;
                } else {
                    $validate_name = false;
                    $errors['name'] = "¡Formato incorrecto, ingrese caracteres!";
                }

                // Database
                if (count($errors) == 0) {
                    require_once 'models/category.php';
                    $category_object = new Category();
                    $query = $category_object->editCategory($id_category, $name_category);
                    if ($query) {
                        $_SESSION['CATEGORY']['UPDATED'] = '¡Categoria actualizada!';
                        header("Location: " . base_url . "category/manage_category");
                    } else {
                        $_SESSION['CATEGORY']['OUTDATED'] = '¡No se ha podido actualizar!';
                        header("Location: " . base_url . "category/manage_category");
                    }
                } else {
                    $_SESSION['CATEGORY']['EDIT']['ERROR'] = $errors;
                    header("Location: " . base_url . "category/edit&id=$id_category");
                }
            }
        }
    }

}
?>


<!---->