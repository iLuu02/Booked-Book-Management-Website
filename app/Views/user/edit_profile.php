<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Booked - Editar pérfil</title>
    <link rel="icon" href="/images/logo.png" type="image/png">
    <link rel="stylesheet" href="/css/edit_profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php
    $user = session()->user;
    ?>

    <div class="d-flex justify-content-center align-items-start mt-5 mb-5">
        <section>
            <form action="/edit_profile" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="container-xl px-5 mt-5">
                    <div class="row">
                        <div class="col-xl-4">
                            <a href="/" class="btn btn-primary mb-3"><i class="fa fa-home"></i></a>
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Foto de perfil</div>
                                <div class="card-body text-center ">
                                    <!-- Profile picture image-->
                                    <img id="previewImage" class="img-account-profile rounded-circle mb" src="<?php echo ($user->image != null) ? 'data:image/jpeg;base64,' . base64_encode($user->image) : '/images/noimage.jpg'; ?>" alt="">
                                    
                                    <!-- Profile picture upload button-->
                                    <label for="inputImage" class="btn btn-primary mt-2">
                                        Subir nueva imagen
                                        <input id="inputImage" name="image" type="file" style="display: none;">
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Detalles de la cuenta</div>
                                <div class="card-body">

                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-2" for="inputUsername">Usuario</label>
                                        <input class="form-control" id="inputUsername" name="name" type="text" placeholder="Introduce un usuario válido" value=<?= $user->name ?> required>

                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-2">
                                            <!-- Form Group (contraseña)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Contraseña" required>
                                            </div>
                                            <!-- Form Group (confirm password)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputConfirmPassword">Confirmar contraseña</label>
                                                <input class="form-control" id="inputConfirmPassword" name="repeatpassword" type="password" placeholder="Repite contraseña" required>
                                            </div>

                                        </div>

                                        <!-- Form Group (email address)-->
                                        <div class="mb-2">
                                            <label class="small mb-1" for="inputEmailAddress">Correo electrónico</label>
                                            <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Introduce un correo válido. Por ej: correo@example.com" value=<?= $user->email ?> required>

                                        </div>


                                        <?php $errors = \Config\Services::validation()->getErrors(); ?>
                                        <?php if ($errors) : ?>
                                            <?php foreach ($errors as $field => $error) : ?>
                                                <div class="alert alert-danger"><?= $error ?></div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if (session()->getFlashdata('msg')) : ?>
                                            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                                        <?php endif; ?>

                                        <!-- Save changes button -->
                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">Guardar los cambios</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </section>
    </div>
    <script src="/js/edit_profile.js"></script>
</body>

</html>