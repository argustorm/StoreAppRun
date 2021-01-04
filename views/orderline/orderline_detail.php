<div class="content-div">
    <h1>¡Pedido realizado!</h1>
    <hr>
    <p>El pedido ha sido realizado y estamos pendientes a que realice<br/>
        el pago al siguiente número de cuenta: "ES196168829856".<br/>
        Una vez efectuado el pago, el pedido será entregado en un plazo de 48h.</p>
    <h3>Detalles del pedido:</h3>
    <hr/>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Unidades</th>
                <th scope="col">Imagen</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $total_price = 0;
            foreach ($_SESSION['CART']['ADD'] as $index => $cart) {
                $total_price += $cart['price'];
                echo "<tr>"
                . "<th>" . $cart['id'] . "</th>
                        <td>" . $cart['name'] . "</td>
                        <td>" . $cart['units'] . "</td>
                        <td>
                        <img alt='" . $cart['name'] . "' "
                . "src='" . base_url . "uploads/img/" . $cart['image'] . "'
                                            width='100'
                                            height='100'/>
                        </td>
                        <td>" . $cart['price'] . "€</td>"
                . "</tr>";
            }
            ?>
        </tbody>
    </table>
    <hr/>
    <h5 class="text-right">Coste total: <?= $total_price ?>€</h5>
    <hr/>
    <div class="text-right">
        <a class="btn btn-outline-primary mt-2"
           href="<?= base_url ?>order/my_orders">
            Aceptar
        </a>
    </div>
</div>