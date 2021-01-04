<nav class="navbar navbar-expand-lg navbar-light bg-light borderadius">
    <a class="navbar-brand" href="<?= base_url ?>">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- Database -->
            <?php
                $db = Database::GetConnection();
                $query = $db->query("select name from category order by id desc;");
                if ($query) {
                    while ($category = mysqli_fetch_assoc($query)) {
                        echo "<li class='nav-item active'>
                            <a class='nav-link' href='#'>".$category['name']."</a>
                        </li>";
                    }
                } else {
                    echo "<p>Error al ejecutar la consulta SQL</p>";
                }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Nombre del producto" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
