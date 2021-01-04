<!-- Sidebar -->
<div class="flex">
    <div>
        <!-- Si no ha iniciado sesión -->
        <?php if (!isset($_SESSION['LOGIN']['USER'])) : ?>
            <?=
            isset($_SESSION['LOGIN']['FAILED']['PASSWORD']) ? alert("danger", $_SESSION['LOGIN']['FAILED']['PASSWORD']) : null;
            ?>
            <div class="sidebar mt-3 shadow">
                <h5 class="text-center">Iniciar sesión</h5>
                <hr/>
                <form action="<?= base_url ?>user/login" method="POST">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" 
                           name="email" 
                           class="form-control"
                           required="true"
                           />
                           <?=
                           isset($_SESSION['LOGIN']['ERROR']['email']) ? alert("danger", $_SESSION['LOGIN']['ERROR']['email']) : null;
                           ?>
                    <label for="password">Contraseña:</label>
                    <input type="password" 
                           name="password" 
                           class="form-control"
                           required="true"
                           />
                           <?=
                           isset($_SESSION['LOGIN']['ERROR']['password']) ? alert("danger", $_SESSION['LOGIN']['ERROR']['password']) : null;
                           ?>
                    <button class="btn btn-outline-primary btn-block mt-2">
                        Iniciar sesión
                    </button>
                </form>
                <div class="center">
                    <?php if (!isset($_SESSION['REGISTER']['COMPLETE'])): ?>
                        <a href="<?= base_url ?>user/register">
                            ¿No tienes cuenta? ¡Registrate!
                        </a>
                    <?php endif; ?>
                </div>
                <?php
                if (isset($_SESSION['REGISTER']['COMPLETE'])) {
                    echo "<p class='green text-center'>" . $_SESSION['REGISTER']['COMPLETE'] . "</p>";
                } else if (isset($_SESSION['REGISTER']['FAILED'])) {
                    echo "<p class='red text-center'>" . $_SESSION['REGISTER']['FAILED'] . "</p>";
                }
                ?>
            </div>
        <?php endif; ?>

        <!-- Si ha iniciado sesión -->    
        <?php if (isset($_SESSION['LOGIN']['USER'])): ?> 
            <?=
            isset($_SESSION['ORDER']['SAVE']['TRUE']) ? alert("success", $_SESSION['ORDER']['SAVE']['TRUE']) : null;
            isset($_SESSION['ORDER']['SAVE']['FALSE']) ? alert("danger", $_SESSION['ORDER']['SAVE']['FALSE']) : null;
            isset($_SESSION['CART']['ADD']['NEW']) ? alert("success", $_SESSION['CART']['ADD']['NEW']) : null;
            isset($_SESSION['PRODUCT']['DELETE']['TRUE']) ? alert("success", $_SESSION['PRODUCT']['DELETE']['TRUE']) : null;
            isset($_SESSION['PRODUCT']['DELETE']['FALSE']) ? alert("success", $_SESSION['PRODUCT']['DELETE']['FALSE']) : null;
            isset($_SESSION['PRODUCT']['EDITED']['TRUE']) ? alert("success", $_SESSION['PRODUCT']['EDITED']['TRUE']) : null;
            isset($_SESSION['PRODUCT']['EDITED']['FALSE']) ? alert("success", $_SESSION['PRODUCT']['EDITED']['FALSE']) : null;
            isset($_SESSION['PRODUCT']['SAVED']) ? alert("success", $_SESSION['PRODUCT']['SAVED']) : null;
            isset($_SESSION['PRODUCT']['UNSAVED']) ? alert("danger", $_SESSION['PRODUCT']['UNSAVED']) : null;
            isset($_SESSION['CATEGORY']['UPDATED']) ? alert("success", $_SESSION['CATEGORY']['UPDATED']) : null;
            isset($_SESSION['CATEGORY']['OUTDATED']) ? alert("success", $_SESSION['CATEGORY']['OUTDATED']) : null;
            isset($_SESSION['CATEGORY']['DELETE']) ? alert("success", $_SESSION['CATEGORY']['DELETE']) : null;
            isset($_SESSION['CATEGORY']['UNDELETE']) ? alert("danger", $_SESSION['CATEGORY']['UNDELETE']) : null;
            isset($_SESSION['CATEGORY']['DELETE']['ERROR']['id']) ? alert("danger", $_SESSION['CATEGORY']['DELETE']['ERROR']['id']) : null;
            isset($_SESSION['CATEGORY']['UNSAVED']) ? alert("danger", $_SESSION['CATEGORY']['UNSAVED']) : null;
            isset($_SESSION['CATEGORY']['SAVED']) ? alert("success", $_SESSION['CATEGORY']['SAVED']) : null;
            ?>
            <div class="sidebar mt-3 shadow">
                <h4 class="text-center">
                    <?php echo $_SESSION['LOGIN']['USER']['name'] . " " . $_SESSION['LOGIN']['USER']['surnames']; ?>
                </h4>
                <hr/>
                <a class="btn btn-outline-success btn-block"
                   href="<?= base_url ?>order/my_orders">Mis Pedidos</a>
                <a class="btn btn-outline-warning btn-block mt-2"
                   href="<?= base_url ?>cart/index">Carrito</a>
                <!-- Modo Administrador -->
                <?php if ($_SESSION['LOGIN']['USER']['rol'] == 'admin') : ?>
                    <a class="btn btn-outline-primary btn-block mt-2"
                       href="<?= base_url ?>category/manage_category">
                        Gestionar Categorias
                    </a>
                    <a class="btn btn-outline-primary btn-block mt-2"
                       href="<?= base_url ?>product/manage_product">
                        Gestionar Productos
                    </a>
                <?php endif; ?>
                <!-- ------------------ -->
                <a href="<?= base_url ?>user/exit"
                   class="btn btn-outline-danger btn-block mt-2">
                    Cerrar sesión
                </a>
            </div>
        <?php endif ?>

    </div>
    <!-- Cierre de procesos -->
    <?php
    if (isset($_SESSION['REGISTER']['COMPLETE'])) {
        unset($_SESSION['REGISTER']['COMPLETE']);
    } else if (isset($_SESSION['REGISTER']['FAILED'])) {
        unset($_SESSION['REGISTER']['FAILED']);
    }
    if (isset($_SESSION['LOGIN']['ERROR'])) {
        unset($_SESSION['LOGIN']['ERROR']);
    }
    if (isset($_SESSION['LOGIN']['FAILED'])) {
        unset($_SESSION['LOGIN']['FAILED']);
    }
    if (isset($_SESSION['CATEGORY']['SAVED'])) {
        unset($_SESSION['CATEGORY']['SAVED']);
    }
    if (isset($_SESSION['CATEGORY']['UNSAVED'])) {
        unset($_SESSION['CATEGORY']['UNSAVED']);
    }
    if (isset($_SESSION['CATEGORY']['DELETE'])) {
        unset($_SESSION['CATEGORY']['DELETE']);
    }
    if (isset($_SESSION['CATEGORY']['UNDELETE'])) {
        unset($_SESSION['CATEGORY']['UNDELETE']);
    }
    if (isset($_SESSION['CATEGORY']['UPDATED'])) {
        unset($_SESSION['CATEGORY']['UPDATED']);
    }
    if (isset($_SESSION['CATEGORY']['OUTDATED'])) {
        unset($_SESSION['CATEGORY']['OUTDATED']);
    }
    if (isset($_SESSION['PRODUCT']['SAVED'])) {
        unset($_SESSION['PRODUCT']['SAVED']);
    }
    if (isset($_SESSION['PRODUCT']['UNSAVED'])) {
        unset($_SESSION['PRODUCT']['UNSAVED']);
    }
    if (isset($_SESSION['PRODUCT']['EDITED']['TRUE'])) {
        unset($_SESSION['PRODUCT']['EDITED']['TRUE']);
    }
    if (isset($_SESSION['PRODUCT']['EDITED']['FALSE'])) {
        unset($_SESSION['PRODUCT']['EDITED']['FALSE']);
    }
    if (isset($_SESSION['PRODUCT']['DELETE']['TRUE'])) {
        unset($_SESSION['PRODUCT']['DELETE']['TRUE']);
    }
    if (isset($_SESSION['PRODUCT']['DELETE']['FALSE'])) {
        unset($_SESSION['PRODUCT']['DELETE']['FALSE']);
    }
    if (isset($_SESSION['CART']['ADD']['NEW'])) {
        unset($_SESSION['CART']['ADD']['NEW']);
    }
    if (isset($_SESSION['ORDER']['SAVE']['TRUE'])) {
        unset($_SESSION['ORDER']['SAVE']['TRUE']);
    }
    if (isset($_SESSION['ORDER']['SAVE']['FALSE'])) {
        unset($_SESSION['ORDER']['SAVE']['FALSE']);
    }
    ?>
    <!-- Content -->
    <div class="flex-content p-3">