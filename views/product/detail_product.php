<div class="content-div">
    <h1 class="text-right"><?= $product['name'] ?></h1>
    <hr/>
    <div class="flex">
        <div>
            <img alt="<?= $product['name'] ?>" 
                 src="<?= base_url ?>uploads/img/<?= $product['image'] ?>"
                 width="300"
                 height="300">
        </div>
        <div class="description">
            <h5><?= $product['description'] ?></h5>
            <h5><strong><?= $product['price'] ?>€</strong></h5>
            <form action="<?= base_url ?>cart/add&id=<?= $product['id'] ?>" method="POST">
                <label class="mt-4" for="units">Seleccione unidades:</label>
                <select name="units" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="btn btn-outline-primary btn-block mt-2">
                    Comprar
                </button>
            </form>
        </div>
    </div>
</div>

