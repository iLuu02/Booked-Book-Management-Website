<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException; // Add this line
use App\Models\BookModel;

class Pages extends BaseController
{
    public function inicio()
    {
        return view('templates/header')
            . view('pages/inicio')
            . view('templates/footer');
    }

    public function categorias($categoria = null, $nombreCat = null)
    {
        $bookModel = new BookModel();

        // Verificar si se proporcionó una categoría
        if ($categoria !== 'categorias') {
            if ($categoria == 'recomendaciones') {
                $books = $bookModel->where('rating >=', 4)->orderBy('name', 'asc')->findAll();
            } elseif ($categoria == 'nuevoslibros') {
                $allBooks = $bookModel->orderBy('name', 'asc')->findAll();
                $randomBooks = array_rand($allBooks, 8);
                $books = array_intersect_key($allBooks, array_flip($randomBooks));
            } else {
                $books = $bookModel->where('genre', $categoria)->orderBy('name', 'asc')->findAll();
            }
        } else {
            $books = $bookModel->orderBy('name', 'asc')->findAll();
        }

        // Pasar los datos a la vista
        $data['books'] = $books;
        $data['categoria'] = $categoria;

        return view('templates/header')
            . view('pages/categorias', $data);
    }

    public function libro($idLibro)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($idLibro);


        $data['book'] = $book;

        return view('templates/header')
            . view('pages/libro', $data)
            . view('templates/footer');
    }


    public function buscarLibros()
    {
        $bookModel = new BookModel();
        $nombreLibro = $this->request->getGet('nombreLibro'); // Obtener el valor del parámetro de búsqueda

        // Realizar la búsqueda en la base de datos por palabras en el nombre del libro
        // Agrega un carácter de comodín al final de $nombreLibro para buscar cualquier libro que comienza con $nombreLibro
        $query = $bookModel->like('name', $nombreLibro . '%')->findAll();

        // Pasar los datos a la vista
        $data['books'] = $query;
        $data['categoria'] = 'resultado'; // Categoría ficticia para mostrar los resultados de búsqueda

        return view('templates/header')
            . view('pages/categorias', $data);
    }
}
