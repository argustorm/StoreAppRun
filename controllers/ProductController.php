<?php

class productController {

    function index() {
        require_once 'models/product.php';
        $product_object = new Product();
        $all_products = $product_object->getAllProducts();
        require_once 'views/product/last_news.php';
    }

    function manage_product() {
        require_once 'views/product/manage_product.php';
    }

    function new_product() {
        require_once 'models/category.php';
        $category_object = new Category();
        $all_categories = $category_object->getAllCategories();
        require_once 'views/product/new_product.php';
    }

    function save() {
        if (isset($_POST) && isset($_FILES)) {
            $errors = [];
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
            $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : null;
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $image_name = $image['name'];
            $tmp_name = $image['tmp_name'];
            $image_type = $image['type'];

            // Validations
            if (!is_numeric($name)) {
                $validate_name = true;
            } else {
                $validate_name = false;
                $errors['name'] = "¡Formato incorrecto!";
            }

            if (!is_numeric($description)) {
                $validate_description = true;
            } else {
                $validate_description = false;
                $errors['description'] = "¡Formato incorrecto!";
            }

            if (is_numeric($price)) {
                $validate_price = true;
            } else {
                $validate_price = false;
                $errors['price'] = "¡Formato incorrecto!";
            }

            if (is_numeric($stock)) {
                $validate_stock = true;
            } else {
                $validate_stock = false;
                $errors['stock'] = "¡Formato incorrecto!";
            }

            if (is_numeric($id_category)) {
                $validate_id = true;
            } else {
                $validate_id = false;
                $errors['id_category'] = "¡Formato incorrecto!";
            }

            // Database 
            if (count($errors) == 0) {
                // Image Validation 
                if (!is_dir("uploads/img")) {
                    mkdir("uploads/img", 0777, true);
                }
                if ($image_type == "image/jpg" ||
                        $image_type == "image/jpeg" ||
                        $image_type == "image/png" ||
                        $image_type == "image/svg") {

                    move_uploaded_file($tmp_name, "uploads/img/$image_name");
                }
                /* ---------------------------------------------------------- */
                require_once 'models/product.php';
                $product_object = new Product();
                $product_object->setName($name);
                $product_object->setDescription($description);
                $product_object->setPrice($price);
                $product_object->setStock($stock);
                $product_object->setId_category($id_category);
                $product_object->setImage($image_name);

                // Query (SAVE)
                $query = $product_object->saveProduct($product_object);

                if ($query) {
                    $_SESSION['PRODUCT']['SAVED'] = "¡Producto guardado con éxito!";
                    header("Location: " . base_url . "product/manage_product");
                } else {
                    $_SESSION['PRODUCT']['UNSAVED'] = "¡Error al guardar el producto!";
                    header("Location: " . base_url . "product/manage_product");
                }
            } else {
                $_SESSION['PRODUCT']['SAVE']['ERROR'] = $errors;
                header("Location: " . base_url . "product/new_product");
            }
        }
    }

    function edit() {
        if ($_GET['id']) {
            $id_product = $_GET['id'];
            require_once 'models/product.php';
            require_once 'models/category.php';
            $category_object = new Category();
            $product_object = new Product();
            $all_categories = $category_object->getAllCategories();
            $product_info = $product_object->getProductById($id_product);
            $product = mysqli_fetch_assoc($product_info);
            require_once 'views/product/edit_product.php';
        }
    }

    function save_edit() {
        if (isset($_GET['id']) && isset($_POST) && isset($_FILES)) {
            $errors = [];
            $id_product = $_GET['id'];
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $price = isset($_POST['price']) ? $_POST['price'] : null;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
            $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : null;
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_type = $image['type'];

            // Validation
            if (is_numeric($id_product)) {
                $validate_id = true;
            } else {
                $validate_id = false;
                $errors['id_product'] = "¡Parámetro 'id' erróneo!";
            }

            if (!is_numeric($name)) {
                $validate_name = true;
            } else {
                $validate_name = false;
                $errors['name'] = "¡Formato Incorrecto!";
            }

            if (!is_numeric($description)) {
                $validate_description = true;
            } else {
                $validate_description = false;
                $errors['description'] = "¡Formato Incorrecto!";
            }

            if (is_numeric($price)) {
                $validate_price = true;
            } else {
                $validate_price = false;
                $errors['price'] = "¡Formato Incorrecto!";
            }

            if (is_numeric($stock)) {
                $validate_stock = true;
            } else {
                $validate_stock = false;
                $errors['stock'] = "¡Formato Incorrecto!";
            }

            if (is_numeric($id_category)) {
                $validate_id_category = true;
            } else {
                $validate_id_category = false;
                $errors['id_category'] = "¡Formato Incorrecto!";
            }


            // Database
            if (count($errors) == 0) {
                // Image Validation ----------------------------------------------
                if ($image_type == "image/jpg" ||
                        $image_type == "image/jpeg" ||
                        $image_type == "image/svg" ||
                        $image_type == "image/png") {
                    if (!is_dir("uploads/img")) {
                        mkdir("uploads/img", 0777, true);
                    }
                    move_uploaded_file($image_tmp_name, "uploads/img/$image_name");
                }
                /* ---------------------------------------------------------------- */

                require_once 'models/product.php';
                $product_object = new Product();
                $product_object->setId_category($id_category);
                $product_object->setName($name);
                $product_object->setDescription($description);
                $product_object->setPrice($price);
                $product_object->setStock($stock);
                $product_object->setImage($image_name);

                // Query
                $query = $product_object->editProduct($id_product, $product_object);
                if ($query) {
                    $_SESSION['PRODUCT']['EDITED']['TRUE'] = "¡Producto actualizado!";
                    header("Location: " . base_url . "product/manage_product");
                } else {
                    $_SESSION['PRODUCT']['EDITED']['FALSE'] = "¡Error al actualizar el producto!";
                    header("Location: " . base_url . "product/manage_product");
                }
            } else {
                $_SESSION['PRODUCT']['EDIT']['ERROR'] = $errors;
                header("Location: " . base_url . "product/edit&id=$id_product");
            }
        }
    }

    function delete() {
        if (isset($_GET['id'])) {
            $errors = [];
            $id_product = $_GET['id'];

            // Validation
            if (is_numeric($id_product)) {
                $validate_id = true;
            } else {
                $validate_id = false;
                $errors['id_product'] = "¡Parámetro 'id' erróneo!";
            }

            // Database
            if (count($errors) == 0) {
                require_once 'models/product.php';
                $product_object = new Product();
                // Query
                $query = $product_object->deleteProduct($id_product);

                if ($query) {
                    $_SESSION['PRODUCT']['DELETE']['TRUE'] = "¡Producto eliminado!";
                    header("Location: " . base_url . "product/manage_product");
                } else {
                    $_SESSION['PRODUCT']['DELETE']['FALSE'] = "¡Error al eliminar el producto!";
                    header("Location: " . base_url . "product/manage_product");
                }
            }
        }
    }

    function detail() {
        if (isset($_GET['id'])) {
            $id_product = $_GET['id'];

            require_once 'models/product.php';
            $product_object = new Product();
            $product_info = $product_object->getProductById($id_product);
            $product = mysqli_fetch_assoc($product_info);

            require_once 'views/product/detail_product.php';
        }
    }

}
