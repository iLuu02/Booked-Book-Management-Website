<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LibraryModel;
use App\Models\BookModel;
use App\Models\UserSettingsModel;

class User extends BaseController
{
    public function admin_list()
    {
        $userModel = new UserModel();
        $bookModel = new BookModel();

        $data['users'] = $userModel->findAll();
        $data['books'] = $bookModel->findAll();

        return view('templates/header')
            . view('user/admin_list', $data)
            . view('templates/footer');
    }

    public function login()
    {
        $validation = \Config\Services::validation();
        $rules = [
            "email" => [
                "label" => "Email",
                "rules" => "required"
                //"rules" => "required|min_length[3]|max_length[20]|valid_email|is_unique[user.email]"
            ],
            "password" => [
                "label" => "Password",
                "rules" => "required"
                //"rules" => "required|min_length[8]|max_length[20]"
            ]
        ];
        $data = [];
        $session = session();
        if ($this->request->getMethod() == "post") {
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = model('UserModel')->authenticate($email, $password);
                if ($user) {
                    $session->set('logged_in', TRUE);
                    $session->set('user', $user);

                    $userModel = model('UserModel');
                    $settingsModel = model('UserSettingsModel');

                    // Obtener el ID del usuario actualmente autenticado
                    $userId = session('user')->id;

                    // Obtener los datos de configuración del usuario desde el modelo UserSettingsModel
                    $settings = $settingsModel->where('user_id', $userId)->first();
                    //var_dump($settings);

                    // Almacenar los datos de configuración en la sesión
                    session()->set('user_settings', $settings);

                    return redirect()->to(base_url('/logged'));
                } else {
                    $session->setFlashdata('msg', 'Credenciales incorrectas');
                }
            } else {
                $data["errors"] = $validation->getErrors();
            }
        }
        return view('user/login', $data);
    }

    public function register()
    {
        $validation = \Config\Services::validation();
        $rules = [
            "name" => [
                "label" => "Name",
                "rules" => "required|alpha_numeric_space"
            ],
            "email" => [
                "label" => "Email",
                "rules" => "required|valid_email|is_unique[user.email]"
            ],
            "password" => [
                "label" => "Password",
                "rules" => "required|min_length[8]|max_length[20]"
            ]
        ];
        $data = [];
        $session = session();
        if ($this->request->getMethod() == "post") {
            if ($this->validate($rules)) {
                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $userModel = new userModel();
                $user = [
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => 1
                ];
                $userModel->insert($user);
                $session->setFlashdata('register-msg', 'Usuario registrado con éxito');

                $settingsModel = new UserSettingsModel();

                // Obtener el ID del nuevo usuario insertado
                $newUserID = $userModel->getInsertID();

                // Crear el array $settingsModel con el ID del usuario
                $settings = [
                    'user_id' => $newUserID,
                    'show_cover' => 1,
                    'show_name' => 1,
                    'show_author' => 1,
                    'show_genre' => 1,
                    'show_pages' => 1,
                    'show_rating' => 1,
                    'show_bin' => 1
                ];

                $settingsModel->insert($settings);

                return redirect()->to(base_url('/login'));
            } else {
                $data["errors"] = $validation->getErrors();
            }
        }
        return view('user/register', $data);
    }

    public function user_ok()
    {
        return view('templates/header')
            . view('pages/inicio')
            . view('templates/footer');
    }

    public function edit_profile()
    {
        return view('user/edit_profile');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/'));
    }

    public function unauthorized()
    {
        return view('templates/header')
            . view('user/unauthorized')
            . view('templates/footer');
    }

    public function update_profile()
    {
        $user = session()->user;
        $session = session();
        $rules = [
            "name" => [
                "label" => "Name",
                "rules" => "required|alpha_numeric_space"
            ],
            "email" => [
                "label" => "Email",
                "rules" => "required|valid_email|is_unique[user.email,id,{$user->id}]"
            ],
            "password" => [
                "label" => "Password",
                "rules" => "required|min_length[8]|max_length[20]|matches[repeatpassword]"
            ],
            "repeatpassword" => [
                "label" => "Repeat Password",
                "rules" => "required|min_length[8]|max_length[20]"
            ],
            "image" => [
                "label" => "Image",
                "rules" => "max_size[image,1024]|is_image[image]"
            ]
        ];

        $validation = \Config\Services::validation();

        $data = [];
        if ($this->validate($rules)) {
            // Obtener los datos enviados desde el formulario
            $username = $this->request->getPost('name');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatpassword');
            $email = $this->request->getPost('email');
            $imageFile = $this->request->getFile('image');

            // Realizar la actualización en la base de datos para el usuario actual
            $user->name = $username;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->email = $email;

            if ($imageFile && $imageFile->isValid()) {
                $user->image = file_get_contents($imageFile->getTempName());
            }
            // Realiza cualquier otra actualización necesaria en el objeto $user

            // Guardar los cambios en la base de datos
            $userModel = new UserModel();
            $userModel->save($user);
            $session->setFlashdata('msg', 'Cambios realizados con éxito');

            // Redirigir al usuario a la página de éxito o mostrar un mensaje de confirmación
        } else {
            $data["errors"] = $validation->getErrors();
        }

        return view('/user/edit_profile', $data);
    }

    public function library($idUsuario)
    {
        // Crear una instancia del modelo Library
        $libraryModel = new \App\Models\LibraryModel();

        // Recuperar todos los libros que están emparejados con el usuario
        $books = $libraryModel->where('id_user', $idUsuario)
            ->join('book', 'library.id_book = book.id')
            ->findAll();

        // Pasar los datos a la vista
        return view('templates/header')
            . view('user/library', ['books' => $books])
            .view('/templates/footer');
    }


    public function addBookToLibrary($idLibro, $idUsuario)
    {
        $libraryModel = new LibraryModel();

        // Verificar si la combinación ya existe en la tabla
        $exists = $libraryModel->where('id_book', $idLibro)
            ->where('id_user', $idUsuario)
            ->first();

        if (!$exists) {
            // Si no existe, añadir el libro a la biblioteca
            $data = [
                'id_book' => $idLibro,
                'id_user' => $idUsuario
            ];
            $libraryModel->insert($data);
            echo json_encode(['success' => true, 'message' => 'Book added to library', 'action' => 'add']);
        } else {
            // Si existe, eliminar el libro de la biblioteca
            $libraryModel->delete($exists->id);
            echo json_encode(['success' => true, 'message' => 'Book removed from library', 'action' => 'remove']);
        }
    }

    public function updateSettings()
    {
        $userId = $this->request->getPost('userId');
        $field = $this->request->getPost('field');
        $value = $this->request->getPost('value');

        $userSettingsModel = new UserSettingsModel();
        $userSettingsModel->update($userId, [$field => $value]);

        $userSettings = $userSettingsModel->find($userId);
        session()->set('user_settings', $userSettings);
    }
}
