<div class="main-margin">
    <div class="container-fluid ml-5">
        <div class="row">
            <div class="col ml-5">
                <h1 class="text-left">Mis Libros</h1>
                <hr class="my-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 mt-5">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <span class="font-weight-bold mb-3" style="font-size: 20px;">Ajustes</span>
                    <div class="d-flex flex-column align-items-start h-100">

                        <?php
                        $user = session()->user;
                        $userSettings = session()->user_settings;
                        ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxPortada">
                            <label class="form-check-label" for="checkboxPortada">
                                Portada
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxNombre">
                            <label class="form-check-label" for="checkboxNombre">
                                Nombre
                            </label>

                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxAutor">
                            <label class="form-check-label" for="checkboxAutor">
                                Autor
                            </label>

                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxGenero">
                            <label class="form-check-label" for="checkboxGenero">
                                Género
                            </label>

                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxPaginas">
                            <label class="form-check-label" for="checkboxPaginas">
                                Páginas
                            </label>

                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxRating">
                            <label class="form-check-label" for="checkboxRating">
                                Rating
                            </label>

                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxBin">
                            <label class="form-check-label" for="checkboxBin">
                                Papelera
                            </label>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <hr class="vertical-line my-5">
            </div>
            <div class="row align-items-center">
                <div class="col ">
                    <div class="row">
                        <div class="col show_cover">Portada</div>
                        <div class="col show_name">Nombre del Libro</div>
                        <div class="col show_author">Autor del Libro</div>
                        <div class="col show_genre">Género</div>
                        <div class="col show_pages">Número de Páginas</div>
                        <div class="col show_rating">Rating</div>
                        <div class="col show_bin">Eliminar</div>
                        <!-- Agrega las clases correspondientes a las otras columnas -->
                    </div>

                    <hr class="my-2">

                    <?php
                    foreach ($books as $book) : ?>

                        <div class="row align-items-center book-row-<?php echo $book->id; ?>">
                            <div class="col mt-4">
                                <div class="row">
                                    <div class="col d-flex align-items-center justify-content-center show_cover">
                                        <a href="/libro/<?php echo $book->id; ?>">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($book->cover); ?>" alt="Portada del libro" class="img-fluid book-cover cover-size">
                                        </a>
                                    </div>
                                    <div class="col d-flex align-items-center show_name">
                                        <a href="/libro/<?php echo $book->id; ?>">
                                            <?php echo $book->name; ?>
                                        </a>
                                    </div>
                                    <div class="col d-flex align-items-center show_author"><?php echo $book->author; ?></div>
                                    <div class="col d-flex align-items-center show_genre">
                                        <a href="/categorias/<?php echo $book->genre; ?>"><?php echo $book->genre; ?></a>
                                    </div>

                                    <div class="col d-flex align-items-center show_pages"><?php echo $book->pages; ?></div>
                                    <div class="col d-flex align-items-center show_rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <?php if ($i <= $book->rating) : ?>
                                                <div>
                                                    <i class="fas fa-star review-positiva-library"></i>
                                                </div>
                                            <?php else : ?>
                                                <div>
                                                    <i class="fas fa-star review-negativa-library"></i>
                                                </div>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="col d-flex align-items-center show_bin">
                                        <i id="deleteBook-<?php echo $book->id; ?>" class="fas fa-trash-alt text-danger col-auto ml-2" data-book-id="<?php echo $book->id; ?>" data-user-id="<?php echo $user->id; ?>"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inicializa el estado de las checkboxes
        $("#checkboxPortada").prop("checked", <?php echo $userSettings->show_cover ?>);
        $("#checkboxNombre").prop("checked", <?php echo $userSettings->show_name ?>);
        $("#checkboxAutor").prop("checked", <?php echo $userSettings->show_author ?>);
        $("#checkboxGenero").prop("checked", <?php echo $userSettings->show_genre ?>);
        $("#checkboxPaginas").prop("checked", <?php echo $userSettings->show_pages ?>);
        $("#checkboxRating").prop("checked", <?php echo $userSettings->show_rating ?>);
        $("#checkboxBin").prop("checked", <?php echo $userSettings->show_bin ?>);

        // Muestra u oculta las propiedades del libro correspondientes al cargar la página
        if ($("#checkboxPortada").prop("checked")) {
            $(".show_cover").addClass("d-flex");
            $(".show_cover").removeClass("d-none");
        } else {
            $(".show_cover").addClass("d-none");
            $(".show_cover").removeClass("d-flex");
        }

        if ($("#checkboxNombre").prop("checked")) {
            $(".show_name").addClass("d-flex");
            $(".show_name").removeClass("d-none");
        } else {
            $(".show_name").addClass("d-none");
            $(".show_name").removeClass("d-flex");
        }

        if ($("#checkboxAutor").prop("checked")) {
            $(".show_author").addClass("d-flex");
            $(".show_author").removeClass("d-none");
        } else {
            $(".show_author").addClass("d-none");
            $(".show_author").removeClass("d-flex");
        }

        if ($("#checkboxGenero").prop("checked")) {
            $(".show_genre").addClass("d-flex");
            $(".show_genre").removeClass("d-none");
        } else {
            $(".show_genre").addClass("d-none");
            $(".show_genre").removeClass("d-flex");
        }

        if ($("#checkboxPaginas").prop("checked")) {
            $(".show_pages").addClass("d-flex");
            $(".show_pages").removeClass("d-none");
        } else {
            $(".show_pages").addClass("d-none");
            $(".show_pages").removeClass("d-flex");
        }

        if ($("#checkboxRating").prop("checked")) {
            $(".show_rating").addClass("d-flex");
            $(".show_rating").removeClass("d-none");
        } else {
            $(".show_rating").addClass("d-none");
            $(".show_rating").removeClass("d-flex");
        }

        if ($("#checkboxBin").prop("checked")) {
            $(".show_bin").addClass("d-flex");
            $(".show_bin").removeClass("d-none");
        } else {
            $(".show_bin").addClass("d-none");
            $(".show_bin").removeClass("d-flex");
        }

        // Controlador de eventos para cuando el estado de la checkbox cambia
        $(".form-check-input").change(function() {
            // Obtén el id de la checkbox que cambió
            var checkboxId = $(this).attr("id");

            // Determina qué propiedad del libro corresponde a la checkbox
            var bookProperty;
            switch (checkboxId) {
                case "checkboxPortada":
                    bookProperty = "show_cover";
                    break;
                case "checkboxNombre":
                    bookProperty = "show_name";
                    break;
                case "checkboxAutor":
                    bookProperty = "show_author";
                    break;
                case "checkboxGenero":
                    bookProperty = "show_genre";
                    break;
                case "checkboxPaginas":
                    bookProperty = "show_pages";
                    break;
                case "checkboxRating":
                    bookProperty = "show_rating";
                    break;
                case "checkboxBin":
                    bookProperty = "show_bin";
                    break;
            }

            // Muestra u oculta la propiedad del libro correspondiente
            if ($(this).prop("checked")) {
                $("." + bookProperty).addClass("d-flex");
                $("." + bookProperty).removeClass("d-none");
            } else {
                $("." + bookProperty).addClass("d-none");
                $("." + bookProperty).removeClass("d-flex");
            }

            // Aquí es donde llamarías a la función AJAX para actualizar la base de datos
            $.post("/updateSettings", {
                userId: <?php echo $user->id; ?>,
                field: bookProperty,
                value: $(this).prop("checked") ? 1 : 0
            });
        });
    });
</script>