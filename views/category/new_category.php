<div class="content-div">
    <h1>Crear nueva categoria</h1>
    <hr/>
    <form action="<?= base_url ?>category/save" method="POST">
        <label for="name">Nombre:</label>
        <input class="form-control"
               name="name"
               required="true"
               type="text"/>
               <?php
               isset($_SESSION['CATEGORY']['ERROR']['name']) 
               ? alert("danger", $_SESSION['CATEGORY']['ERROR']['name']) 
               : null;
               ?>
        <button class="btn btn-outline-primary btn-block mt-2">
            Crear
        </button>
    </form>
    <?php
        if (isset($_SESSION['CATEGORY']['ERROR']['name'])) {
        unset($_SESSION['CATEGORY']['ERROR']['name']);
    }
    ?>
</div>

