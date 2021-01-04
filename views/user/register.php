<div class="form-register p-3">
    <h1>Registro</h1>
    <hr/>
    <form action="<?= base_url ?>user/save" 
          method="POST" 
          enctype="multipart/form-data">
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control" required="true"/>
        <?= isset($_SESSION['REGISTER']['ERROR']['name']) ? alert("danger", $_SESSION['REGISTER']['ERROR']['name']) : null
        ?>
        <label for="surnames">Apellidos:</label>
        <input type="text" name="surnames" class="form-control" required="true"/>
        <?= isset($_SESSION['REGISTER']['ERROR']['surnames']) ? alert("danger", $_SESSION['REGISTER']['ERROR']['surnames']) : null
        ?>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" class="form-control" required="true"/>
        <?= isset($_SESSION['REGISTER']['ERROR']['email']) ? alert("danger", $_SESSION['REGISTER']['ERROR']['email']) : null
        ?>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" class="form-control" required="true"/>
        <?= isset($_SESSION['REGISTER']['ERROR']['password']) ? alert("danger", $_SESSION['REGISTER']['ERROR']['password']) : null
        ?>
        <label for="rpassword">Repita la contraseña:</label>
        <input type="password" name="rpassword" class="form-control" required="true"/>
        <?= isset($_SESSION['REGISTER']['ERROR']['password']) ? alert("danger", $_SESSION['REGISTER']['ERROR']['password']) : null
        ?>
        <button class="btn btn-outline-primary btn-block mt-3">
            Registrarse
        </button>
    </form>
    <?php
    if (isset($_SESSION['REGISTER'])) {
        unset($_SESSION['REGISTER']);
    }
    ?>
</div>

