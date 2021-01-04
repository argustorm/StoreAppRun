<div class="content-div">
    <h1>Mis pedidos</h1>
    <hr/>
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col">NºPedido</th>
                <th scope="col">Coste</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($order = mysqli_fetch_assoc($all_orders)) {
                echo "<tr>
                        <th><a href='".base_url."order/detail&id=".$order['id']."'>".$order['id']."</a></th>
                        <td>".$order['cost']."€</td>
                        <td>".$order['date']."</td>
                    </tr>";
            }
            ?>
            
            
        </tbody>
    </table>
</div>
