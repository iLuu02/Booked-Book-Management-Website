<!DOCTYPE html>
<html class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Booked</title>
    <link rel="icon" href="/images/logo.png" type="image/png">

    <link rel="stylesheet" type="text/css" href="/css/inicio.css">
    <link rel="stylesheet" type="text/css" href="/css/header_inferior.css">
    <link rel="stylesheet" type="text/css" href="/css/header_superior.css">
    <link rel="stylesheet" type="text/css" href="/css/categorias.css">
    <link rel="stylesheet" type="text/css" href="/css/libro.css">
    <link rel="stylesheet" type="text/css" href="/css/library.css">
    <link rel="stylesheet" type="text/css" href="/css/admin_list.css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="d-flex flex-column h-100">
    <header class="sticky-top">
        <nav class="top-navbar">
            <div class="logo">
                <a href="/"><span class="logo-text">Booked</span></a>
            </div>

            <?php
            $session = session();
            if ($session->has('logged_in')) {
                echo '<form class= "ml-auto" action="' . base_url('buscarLibros') . '" method="GET">';
                echo     '<div class="search-bar ml-auto">';
                echo         '<input type="text" name="nombreLibro" placeholder="Buscar nuevo libro por nombre">';
                echo         '<button type="submit"><i class="fas fa-search"></i></button>';
                echo     '</div>';
                echo '</form>';
            } else {
                echo '<form action="' . base_url('buscarLibros') . '" method="GET">';
                echo     '<div class="search-bar">';
                echo         '<input type="text" name="nombreLibro" placeholder="Buscar nuevo libro por nombre">';
                echo         '<button type="submit"><i class="fas fa-search"></i></button>';
                echo     '</div>';
                echo '</form>';
            }
            ?>

            <?php
            $session = session();

            if ($session->has('logged_in')) {
                $logged_in = session()->logged_in;

                if ($logged_in == TRUE) {
                    $user = session()->user;
                    $url = "/logout";

                    echo '<a href="/library/' . $user->id . '" class="my-library-button ml-auto"><i class="fas fa-book"></i> Mi Biblioteca</a>';
                    echo '<div class="buttons">';

                    echo '<div class="user-menu">';
                    echo '<div class="user-info">';

                    // Mostrar imagen de perfil
                    if ($user->image != null) {
                        $imageData = base64_encode($user->image);
                        echo '<img class="img-account-profile rounded-circle mr-2" src="data:image/jpeg;base64,' . $imageData . '" alt="">';
                    } else {
                        echo '<img class="img-account-profile rounded-circle" src="/images/noimage.jpg" alt="">';
                    }

                    echo '<span class="user-name">' . $user->name . '</span>';
                    echo '</div>';
                    echo '<ul class="user-options">';
                    echo '<li><a href="/edit_profile">Editar Perfil</a></li>';
                    if ($user->role == 3) {
                        echo '<li><a href="/admin_list">Opciones de Administrador</a></li>';
                    }
                    echo '<li><a href="/logout">Cerrar Sesión</a></li>';
                    echo '</ul>';
                    echo '</div>';
                }
            } else {
                echo '<div class="buttons">';
                echo '<a href="/login" class="login-button">Iniciar Sesión</a>';
                echo '<a href="/register" class="register-button">Registrarse</a>';
            }
            ?>

            </div>
        </nav>

        <?php

        $nuevosLibros = site_url("categorias/nuevoslibros");
        $recomendados = site_url("categorias/recomendaciones");
        $categorias = site_url("categorias/categorias");

        $enlaces = array(
            "Ciencia Ficción" => site_url("categorias/ciencia_ficcion"),
            "Crimen" => site_url("categorias/crimen"),
            "Fantasía" => site_url("categorias/fantasia"),
            "Historia" => site_url("categorias/historia"),
            "Humor" => site_url("categorias/humor"),
            "Manga" => site_url("categorias/manga"),
            "Psicológico" => site_url("categorias/psicologico"),
            "Romance" => site_url("categorias/romance"),
            "Suspense" => site_url("categorias/suspense"),
            "Terror" => site_url("categorias/terror"),
            "Viajes" => site_url("categorias/viajes")
        );
        ?>

        <nav class="bottom-navbar">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="<?= $nuevosLibros ?>">Nuevos Libros</a></li>
                <li><a href="<?= $recomendados ?>">Recomendaciones</a></li>
            </ul>
            <div class="dropdown">
                <a href="<?= $categorias ?>">
                    <button class="dropbtn">Categorías</button>
                </a>
                <div class="dropdown-content">
                    <?php foreach ($enlaces as $slug => $url) : ?>
                        <a href="<?= $url ?>"><?= ucfirst($slug) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="/js/header.js"></script>
    <script src="/js/library.js"></script>