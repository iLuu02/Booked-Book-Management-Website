<div class="margin">
    <div class="container-fluid align-items-center my-auto">
        <div class="row">
            <div class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($book->cover); ?>" alt="Portada del libro" class="img-fluid book-cover">

                <?php
                $session = session();
                $idLibro = $book->id;
                if ($session->has('logged_in')) {
                    $idUsuario = session()->user->id;

                    // Crear una instancia del modelo Library
                    $libraryModel = new \App\Models\LibraryModel();
                    // Verificar si la combinación ya existe en la tabla
                    $exists = $libraryModel->where('id_book', $idLibro)
                        ->where('id_user', $idUsuario)
                        ->first();
                    $buttonText = $exists ? 'Eliminar libro' : 'Añadir libro a tu lista';
                    echo '<button id="add-to-library" class="btn btn-custom rounded-pill w-75 mx-auto mt-3">' . $buttonText . '</button>';
                }
                ?>

            </div>
            <div class="col-md-9 mt-2">
                <h3 class="ml-3 mb-2"><?= $book->name ?></h3>
                <p class="ml-3"><em><?= $book->author ?></em></p>
                <div class="row ml-1 align-items-center">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <?php if ($i <= $book->rating) : ?>
                            <div class="col-auto">
                                <i class="fas fa-star review-positiva"></i>
                            </div>
                        <?php else : ?>
                            <div class="col-auto">
                                <i class="fas fa-star review-negativa"></i>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <div class="col-auto ml-2 font-weight-bold review" style="font-size: 30px;"><?= $book->rating ?></div>
                </div>


                <p class="ml-3 mt-3 mr-5"><?= $book->description ?></p>

                <div class="mt-5">
                    <p class="ml-3">Género: <a href="/categorias/<?= $book->genre ?>"><?= $book->genre ?></a></p>
                    <p class="ml-3">Páginas: <?= $book->pages ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($idLibro) && isset($idUsuario)) : ?>
    <script>
        $(document).ready(function() {
            $('#add-to-library').click(function() {
                $.ajax({
                    url: '/addBookToLibrary/<?php echo $idLibro; ?>/<?php echo $idUsuario; ?>',
                    method: 'POST',
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            // Cambiar el texto del botón según la acción realizada
                            if (data.action === 'add') {
                                $('#add-to-library').text('Eliminar libro');
                            } else {
                                $('#add-to-library').text('Agregar libro a la biblioteca');
                            }
                        } else {
                            console.log(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = JSON.parse(xhr.responseText);
                        console.log(err.message);
                    }
                });
            });
        });
    </script>
<?php endif; ?>