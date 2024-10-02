<section>
    <div class="main">

        <div class="main_tag">
            <h1>BIENVENIDO A<br><span>BOOKED</span></h1>

            <p>
                Booked es una página web de exploración de libros. Descubre nuevas novedades en nuestro gran catálogo de libros.
                ¿No sabes que leer? Navega entre libros destacados y nuevas recomendaciones.
                Añade libros nuevos a tu biblioteca, ordenalos a gusto para siempre saber cual será tu nueva lectura.
                <br><br>¿Quieres aprender más?
            </p>

            <?php
            $session = session();

            if ($session->has('logged_in')) {
                echo '<a href="/categorias/categorias" class="main_btn">Explorar</a>';
            } else {
                echo '<a href="/register" class="main_btn">Únete ahora</a>';
            }
            ?>

        </div>

        <div class="main_img">
            <img src="images/table.png">
        </div>

    </div>
</section>