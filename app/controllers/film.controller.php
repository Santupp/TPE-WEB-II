<?php
require_once 'app/models/film.model.php';
require_once 'app/views/film.view.php';
class FilmController
{
    private $model;
    private $view;


    public function __construct()
    {
        $this->model = new FilmModel();
        $this->view = new FilmView();
    }
    public function showFilms()
    {
        $films = $this->model->getFilms();
        $this->view->showFilms($films);
    }

    public function addFilms() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar los datos del formulario
            $nombre = $_POST['nombre'];
            $estreno = $_POST['estreno'];
            $genero = $_POST['genero'];
            $descripcion = $_POST['descripcion'];
            $director = $_POST['director'];

            if ($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png") {
                $resultado = $this->model->addFilm($nombre, $estreno, $genero, $director,$descripcion , $_FILES['input_name']['tmp_name']);
            } else {
                $resultado = $this->model->addFilm($nombre, $estreno, $genero, $director, $descripcion);
            }

            // Redirigir dependiendo del resultado
            if ($resultado) {
                header('Location: ' . BASE_URL . 'peliculas?mensaje=Película agregada con éxito');
            } else {
                header('Location: ' . BASE_URL . 'agregarPelicula?mensaje=Error al agregar la película');
            }
        } else {
            // Mostrar el formulario para agregar película
            $this->showAddFilmForm();
        }
    }
    public function showAddFilmForm() {
        $directors = $this->model->getDirectors();
        $this->view->showAddFilmForm($directors);
    }

    public function showFilm($id)
    {
        $film = $this->model->getFilm($id);
        if ($film) {    
            $film->director_name = $this->model->getDirectorNameById($film->id_director);
        }
        $this->view->showFilm($film);
    }

    public function showFilmsByDirector($directorID) {
        $director = $this->model->getDirectorById($directorID);
        if (!$director) {
            $this->view->showError("Director no es valido.");
            return;
        }
        $peliculas = $this->model->getFilmsByDirector($directorID);
        $this->view->showFilmsByDirector($peliculas, $director);
    }
}