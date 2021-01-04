<div class="content-div">
    <h1>Crear nuevo producto</h1>
    <hr/>
    <form action="<?= base_url ?>product/save" method="POST" enctype="multipart/form-data">
        <!--Nombre-->
        <label for="name">Nombre:</label>
        <input type="text"
               name="name" 
               class="form-control" 
               required="true"/>
               <?= isset($_SESSION['PRODUCT']['SAVE']['ERROR']['name']) ? alert("danger", $_SESSION['PRODUCT']['SAVE']['ERROR']['name']) : null ?>

        <!--Descripcion-->
        <label for="description">Descripción:</label>
        <textarea class="form-control" 
                  name="description" 
                  rows="3"
                  required="true"></textarea>
                  <?= isset($_SESSION['PRODUCT']['SAVE']['ERROR']['description']) ? alert("danger", $_SESSION['PRODUCT']['SAVE']['ERROR']['description']) : null ?>

        <!--Precio-->
        <label for="price">Precio:</label>
        <input type="number"
               name="price"
               class="form-control"
               required="true">
        <?= isset($_SESSION['PRODUCT']['SAVE']['ERROR']['price']) ? alert("danger", $_SESSION['PRODUCT']['SAVE']['ERROR']['price']) : null?>

        <!--Stock-->
        <label for="stock">Stock:</label>
        <input type="number"
               name="stock"
               class="form-control"
               required="true"/>
        <?= isset($_SESSION['PRODUCT']['SAVE']['ERROR']['stock']) ? alert("danger", $_SESSION['PRODUCT']['SAVE']['ERROR']['stock']) : null?>

        <!--Categoria-->
        <label for="id_category">Seleccione la categoria</label>
        <select name="id_category" class="form-control">
            <?php
            while ($category = mysqli_fetch_assoc($all_categories)) {
                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
            }
            ?>
        </select>
        <?= isset($_SESSION['PRODUCT']['SAVE']['ERROR']['id_category']) ? alert("danger", $_SESSION['PRODUCT']['SAVE']['ERROR']['id_category']) : null?>

        <!--Imagen-->
        <label for="image">Seleccione la imágen del producto</label>
        <input type="file" 
               class="form-control-file" 
               name="image"
               required="true">
        <button class="btn btn-outline-primary mt-2">
            Crear producto
        </button>
    </form>
    <?php
        if (isset($_SESSION['PRODUCT']['SAVE']['ERROR'])) {
            unset ($_SESSION['PRODUCT']['SAVE']['ERROR']);
        }
    ?>
</div>
