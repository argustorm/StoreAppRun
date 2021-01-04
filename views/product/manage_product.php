<div class="content-div">
    <h1>Gestionar productos</h1>
    <hr/>
    <a class="btn btn-outline-primary"
       href="<?=base_url?>product/new_product">
        Añadir nuevo producto
    </a>
    <div class="table-shadow">
        <table class="table table-hover mt-3 text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="p-3">
                <?php
                require_once 'models/product.php';
                $product_object = new Product();
                $all_products = $product_object->getAllProducts();
                while ($product = mysqli_fetch_assoc($all_products)) {
                    echo '<tr>
                            <th>'.$product['id'].'</th>
                            <td>'.$product['name'].'</td>
                            <td>
                                <a class="btn btn-warning"
                                   href="'.base_url.'product/edit&id='.$product['id'].'">Editar</a>
                                <a class="btn btn-danger"
                                   href="'.base_url.'product/delete&id='.$product['id'].'">Borrar</a>
                            </td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
