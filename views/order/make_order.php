<div class="content-div">
    <!--En caso de que el usuario haya iniciado sesión-->
    <?php if (isset($_SESSION['LOGIN']['USER'])) : ?>
        <div class="flex">
            <h1>Realizar Pedido</h1>
            <div class="btn-detail-cart">
                <a class="btn btn-outline-primary"
                   href="<?= base_url ?>cart/index">
                    Ver pedido
                </a>
            </div>
        </div>
        <hr/>
        <form action="<?=base_url?>order/add_order" method="POST">
            <!--Provincia-->
            <label for="province">Provincia:</label>
            <input type="text"
                   name="province"
                   class="form-control"
                   required="true">
            <?= isset($_SESSION['ORDER']['SAVE']['ERROR']['province']) 
            ? alert("danger", $_SESSION['ORDER']['SAVE']['ERROR']['province']) 
            : null ?>
            
            <!--Localidad-->
            <label for="locality">Ciudad:</label>
            <input type="text"
                   name="locality"
                   class="form-control"
                   required="true">
            <?= isset($_SESSION['ORDER']['SAVE']['ERROR']['locality']) 
            ? alert("danger", $_SESSION['ORDER']['SAVE']['ERROR']['locality']) 
            : null ?>

            <!--Dirección-->
            <label for="address">Dirección:</label>
            <input type="text"
                   name="address"
                   class="form-control"
                   required="true">
            <?= isset($_SESSION['ORDER']['SAVE']['ERROR']['address']) 
            ? alert("danger", $_SESSION['ORDER']['SAVE']['ERROR']['address']) 
            : null ?>

            <button class="btn btn-outline-primary mt-2 btn-block">
                Confirmar pedido
            </button>
        </form>
    <?php endif; ?>
    
    <!--En caso de que el usuario no haya iniciado sesión-->
    <?php if (!isset($_SESSION['LOGIN']['USER'])) : ?>
        <?php
        alert("info", "¡Debe iniciar sesión para realizar el pedido!");
        ?>
        <!--Será redireccionado a Inicio-->
        <script>
            setTimeout("location.href='http://localhost/masterphp/StoreAppRUN/'", 3000);
        </script>
    <?php endif; ?>
        
    <?php
    if (isset($_SESSION['ORDER']['SAVE']['ERROR'])) {
        unset($_SESSION['ORDER']['SAVE']['ERROR']);
    }
    ?>
</div>

