<div class="content-div">
    <h1>Detalles del pedido</h1>
    <hr/>
    <div class="shadow send-data">
        <h4>Datos de envío</h4>
        <hr/>
        <p><strong>Provincia: </strong><?= $order['province'] ?>
            <br/>
            <strong>Ciudad/Localidad: </strong><?= $order['location'] ?>
            <br/>
            <strong>Dirección: </strong><?= $order['address'] ?>
        </p>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Unidades</th>
                <th scope="col">Imagen</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($orderline = mysqli_fetch_assoc($orderline_detail)) {
                $product_detail = $product_object->getProductById($orderline['product_id']);
                while ($product = mysqli_fetch_assoc($product_detail)) {
                    echo "<tr>
                        <th><a href='" . base_url . "product/detail&id=" . $product['id'] . "'>" . $product['id'] . "</a></th>
                        <td>" . $product['name'] . "</td>
                        <td>" . $orderline['units'] . "</td>
                        <td>
                            <img alt='" . $product['name'] . "' 
                                 src='" . base_url . "uploads/img/" . $product['image'] . "'
                                 width='100'
                                 height='100'/>
                        </td>
                        <td>" . $product['price'] * $orderline['units'] . "€</td>";
                }
            }
            ?>
        </tbody>
    </table>
</div>