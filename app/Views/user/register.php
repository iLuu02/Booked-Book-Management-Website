<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Regístrate en Booked</title>
    <link rel="icon" href="/images/logo.png" type="image/png">
    <link rel="stylesheet" href="/css/register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />


</head>

<body>

    <div class="container-fluid ps-md-0">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4">Regístrate en Booked</h3>

                                <!-- Sign In Form -->
                                <form action=<?= base_url('/register'); ?> method="post">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInputName" name="name" required placeholder="Nombre de usuario">
                                        <label for="floatingInput">Nombre de usuario</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" name="email"  required placeholder="Correo electrónico. Ej: name@example.com">
                                        <label for="floatingInput">Correo electrónico</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" name="password"  required placeholder="Contraseña">
                                        <label for="floatingPassword">Contraseña</label>
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


                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Crear cuenta</button>
                                        <div class="text-center">
                                            <p class="small"> ¿Ya tienes una cuenta?
                                                <a href="/login">Inicia sesión</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="/" class="btn btn-link btn-home"><i class="fas fa-home"></i></a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
