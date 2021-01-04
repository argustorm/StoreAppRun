<div class="content-div">
    <h1>Gestionar categorias</h1>
    <hr/>
    <?= isset($_SESSION['CATEGORY']['INDELIBLE']) ? alert("danger", $_SESSION['CATEGORY']['INDELIBLE']) : null ?>
    <a class="btn btn-outline-primary"
       href="<?= base_url ?>category/new_category">
        Añadir nueva categoria
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
                require_once 'models/category.php';
                $category_object = new Category();
                $all_categories = $category_object->getAllCategories();
                while ($category = mysqli_fetch_assoc($all_categories)) {
                    echo '<tr>
                            <th>' . $category['id'] . '</th>
                            <td>' . $category['name'] . '</td>
                            <td>
                                <a class="btn btn-warning"
                                   href="' . base_url . 'category/edit&id=' . $category['id'] . '">Editar</a>
                                <a class="btn btn-danger"
                                   href="' . base_url . 'category/delete&id=' . $category['id'] . '">Borrar</a>
                            </td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    if (isset($_SESSION['CATEGORY']['INDELIBLE'])) {
        unset($_SESSION['CATEGORY']['INDELIBLE']);
    }
    ?>
</div>

