<div class="content-div">
    <h1>Editar "<?= $product['name'] ?>"</h1>
    <hr>
    <form action="<?= base_url ?>product/save_edit&id=<?= $id_product ?>"
          method="POST"
          enctype="multipart/form-data">
        <!--Nombre-->
        <label for="name">Nombre:</label>
        <input type="text"
               class="form-control"
               required="true"
               name="name"
               value="<?= $product['name'] ?>"/>
               <?= isset($_SESSION['PRODUCT']['EDIT']['ERROR']['name']) ? alert("danger", $_SESSION['PRODUCT']['EDIT']['ERROR']['name']) : null ?>

        <!--Descripción-->
        <label for="description">Descripción:</label>
        <textarea class="form-control" 
                  rows="3"
                  required="true"
                  name="description"
                  value="<?= $product['description'] ?>"></textarea>
                  <?= isset($_SESSION['PRODUCT']['EDIT']['ERROR']['description']) ? alert("danger", $_SESSION['PRODUCT']['EDIT']['ERROR']['description']) : null ?>

        <!--Precio-->
        <label for="price">Precio:</label>
        <input type="number"
               class="form-control"
               required="true"
               name="price"
               value="<?= $product['price'] ?>"/>
               <?= isset($_SESSION['PRODUCT']['EDIT']['ERROR']['price']) ? alert("danger", $_SESSION['PRODUCT']['EDIT']['ERROR']['price']) : null ?>

        <!--Stock-->
        <label for="stock">Stock:</label>
        <input type="number"
               class="form-control"
               required="true"
               name="stock"
               value="<?= $product['stock'] ?>"/>
               <?= isset($_SESSION['PRODUCT']['EDIT']['ERROR']['stock']) ? alert("danger", $_SESSION['PRODUCT']['EDIT']['ERROR']['stock']) : null ?>

        <!--Categoria-->
        <label for="id_category">Seleccione una categoria:</label>
        <select name="id_category" class="form-control">
            <?php
            while ($category = mysqli_fetch_assoc($all_categories)) {
                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
            }
            ?>
        </select>
        <?= isset($_SESSION['PRODUCT']['EDIT']['ERROR']['id_category']) ? alert("danger", $_SESSION['PRODUCT']['EDIT']['ERROR']['id_category']) : null ?>

        <!--Imagen-->
        <label for="image">Seleccione una imagen:</label>
        <input type="file" 
               class="form-control-file" 
               name="image"
               required="true"
               value="<?= $product['image'] ?>"/>

        <button class="btn btn-outline-primary mt-2 btn-block">
            Guardar cambios
        </button>
    </form>
    <?php
    if (isset($_SESSION['PRODUCT']['EDIT']['ERROR'])) {
        unset($_SESSION['PRODUCT']['EDIT']['ERROR']);
    }
    ?>
</div>
