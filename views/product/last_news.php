<div class="content-init flex-content">
<?php   
while ($product = mysqli_fetch_assoc($all_products)) {
    echo "<div class='card-product shadow text-center'>
            <img alt='".$product['name']."'  
                 src='uploads/img/".$product['image']."' 
                 width='100' 
                 height='100'>
            <h4>".$product['name']."</h4>
            <strong>".$product['price']."€</strong>
            <a href='".base_url."product/detail&id=".$product['id']."' class='btn btn-outline-primary btn-block mt-2'>
                Ver más
            </a>
        </div>";
}
?>
</div>
</div>
</div>
