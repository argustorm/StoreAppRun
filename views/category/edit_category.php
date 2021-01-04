<div class="content-div">
    <h1>Editar "<?= $category->name ?>"</h1>
    <hr/>
    <form action="<?= base_url ?>category/edit_saved&id=<?= $category->id ?>" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" 
               name="name" 
               class="form-control"
               placeholder="<?= $category->name ?>"
               required="true"/>
               <?=
               isset($_SESSION['CATEGORY']['EDIT']['ERROR']['name']) 
                    ? alert("danger", $_SESSION['CATEGORY']['EDIT']['ERROR']['name']) 
                    : null
               ?>
        <button class="btn btn-outline-primary btn-block mt-2">
            Guardar cambios
        </button>
    </form>
    <?php
    if (isset($_SESSION['CATEGORY']['EDIT']['ERROR'])) {
        unset($_SESSION['CATEGORY']['EDIT']['ERROR']);
    }
    ?>
</div>