<div class="content-div">
    <div class="flex">
        <h1>Mi carrito</h1>
        <div class="btn-remove-cart">
            <a class="btn btn-outline-danger"
               href="<?= base_url ?>cart/remove_all">
                Vaciar todo
            </a>
        </div>
    </div>
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
            foreach ($product_array as $product) {

                $total_price += $product['price'];
                echo "<tr>
                        <th><p class='mt-5'>" . $product['id'] . "</p></th>
                        <td><p class='mt-5'>" . $product['name'] . "</p></td>
                        <td><p class='mt-5'>" . $product['units'] . "</p></td>
                        <td>
                            <img alt   = '" . $product['name'] . "'
                                 src   = '" . base_url . "uploads/img/" . $product['image'] . "'
                                 width = '100'
                                 height= '100'/>
                        </td>
                        <td><p class='mt-5'>" . $product['price'] . "€</p></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <hr/>
    <h4 class="text-right">Precio total: <?= $total_price ?>€ </h4>
    <div class="text-right">
        <a class="btn btn-outline-primary mt-2"
           href="<?= base_url ?>order/index">
            Realizar pedido
        </a>
    </div>
</div>
