<section>
    <?php
    $urlNuevosLibros = site_url("categorias/nuevoslibros");
    $urlRecomendaciones = site_url("categorias/recomendaciones");

    $categoriasUrls = array(
        "categorias" => site_url("categorias/categorias"),
        "ciencia_ficcion" => site_url("categorias/ciencia_ficcion"),
        "crimen" => site_url("categorias/crimen"),
        "fantasia" => site_url("categorias/fantasia"),
        "historia" => site_url("categorias/historia"),
        "humor" => site_url("categorias/humor"),
        "manga" => site_url("categorias/manga"),
        "psicologico" => site_url("categorias/psicologico"),
        "romance" => site_url("categorias/romance"),
        "suspense" => site_url("categorias/suspense"),
        "terror" => site_url("categorias/terror"),
        "viajes" => site_url("categorias/viajes")
    );

    $categoriasNombre = array(
        "categorias" => "Todas las Categorías",
        "ciencia_ficcion" => "Ciencia Ficción",
        "crimen" => "Crimen",
        "fantasia" => "Fantasía",
        "historia" => "Historia",
        "humor" => "Humor y Comedia",
        "manga" => "Manga",
        "psicologico" => "Psicológicos",
        "romance" => "Romance",
        "suspense" => "Suspense",
        "terror" => "Terror",
        "viajes" => "Viajes"
    );

    ?>

    <div class="sidebar">
        <ul>
            <li><a href="<?= $urlNuevosLibros ?>">Nuevos libros</a></li>
            <li><a href="<?= $urlRecomendaciones ?>">Recomendaciones</a></li>
            <li class="has-submenu">Categorías
                <ul>
                    <?php

                    foreach ($categoriasUrls as $slug => $url) : ?>
                        <li><a href="<?= $url ?>"><?= getNombreCategoria($slug) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </div>


    <div class="book-area">
        <div class="section-title">
            <?php
            // Verificar si es una búsqueda
            if (isset($_GET['nombreLibro'])) {
                $busqueda = $_GET['nombreLibro'];
                echo '<p>Buscando libros por: "' . $busqueda . '"</p>';
            } else {
                // Obtener la categoría de la URL
                $url = $_SERVER['REQUEST_URI'];
                $categoria = basename($url);

                // Obtener el nombre de la categoría
                $nombreMostrado = getNombreCategoria($categoria);
                echo '<p>' . $nombreMostrado . '</p>';
            }
            ?>
        </div>

        <div class="grid-container">
            <?php foreach ($books as $book) : ?>
                <a href="/libro/<?php echo $book->id; ?>" class="grid-item">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($book->cover); ?>" alt="Portada del libro">
                    <p><?php echo $book->name; ?></p>
                    <i><?php echo $book->author; ?></i>
                </a>
            <?php endforeach; ?>
        </div>
</section>

<?php
function getNombreCategoria($categoria)
{
    $categorias = array(
        "categorias" => "Todas las Categorías",
        "nuevoslibros" => "Nuevos libros",
        "recomendaciones" => "Recomendaciones",
        "ciencia_ficcion" => "Ciencia Ficción",
        "crimen" => "Crimen",
        "fantasia" => "Fantasía",
        "historia" => "Historia",
        "humor" => "Humor y Comedia",
        "manga" => "Manga",
        "psicologico" => "Psicológicos",
        "romance" => "Romance",
        "suspense" => "Suspense",
        "terror" => "Terror",
        "viajes" => "Viajes"
    );

    $categoria = strtolower($categoria); // Convertir a minúsculas

    return isset($categorias[$categoria]) ? $categorias[$categoria] : "Categoría desconocida";
}

?>