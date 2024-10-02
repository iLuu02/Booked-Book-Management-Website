<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

use App\Controllers\User;

# Simula el inicio de la web.
$routes->match(['get', 'post'], '/login', [User::class, 'login']); #Formulario de inicio de sesión
$routes->match(['get', 'post'], '/register', [User::class, 'register']); #Formulario de registro
$routes->match(['get'], '/logged', [User::class, 'user_ok']); #Usuario conectado con éxito
$routes->get('library/(:any)', 'User::library/$1', ['filter' => 'user_auth']); #Usuario intenta acceder a su biblioteca
$routes->post('addBookToLibrary/(:any)/(:any)', 'User::addBookToLibrary/$1/$2', ['filter' => 'user_auth']); #Se intenta añadir o borrar un libro de la biblioteca
$routes->post('updateSettings/', 'User::updateSettings', ['filter' => 'user_auth']); #Se intenta actualizar los ajustes de la biblioteca del usuario
$routes->match(['get'], '/edit_profile', [User::class, 'edit_profile'], ['filter' => 'user_auth']); #Entrar a la vista editar perfil
$routes->match(['post'], '/edit_profile', [User::class, 'update_profile'], ['filter' => 'user_auth']); #Envio de los datos de actualizar perfil
$routes->match(['get'], '/admin_list', [User::class, 'admin_list'], ['filter' => 'admin_auth']); #Lista de opciones para usuario administrador
$routes->match(['get'], '/unauthorized', [User::class, 'unauthorized']); #Usuario no autorizado. Por ejemplo usuario normal intentando acceder a admin_list
$routes->match(['get'], '/logout', [User::class, 'logout']); #Cerrar sesion

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Pages::inicio'); #Página de inicio
$routes->get('categorias/(:any)', 'Pages::categorias/$1/$2'); #Página de categorias que muestra los libros por género o todos los géneros
$routes->get('libro/(:any)', 'Pages::libro/$1'); #Página de detalles de libro
$routes->get('buscarLibros', 'Pages::buscarLibros'); #Buscar libros en la barra de búsqueda

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
