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
        $view = new FilmView(); // Instancia de la vista
        $view->addFilm(); // Llamar a la vista que contiene el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar los datos del formulario
            $nombre= $_POST['nombre'];
            $estreno = $_POST['estreno'];
            $genero = $_POST['genero'];

            // Intentar agregar la película a la base de datos
            $resultado = $this->model->addFilm($nombre, $estreno, $genero);

            // Redirigir dependiendo del resultado
            if ($resultado) {
                header('Location: ' . BASE_URL . 'peliculas?mensaje=Película agregada con éxito');
            } else {
                header('Location: ' . BASE_URL . 'agregarPelicula?mensaje=Error al agregar la película');
            }
        }


    }


    public function showFilm($id)
    {
        $film = $this->model->getFilm($id);
        $this->view->showFilm($film);
    }
    public function showGenres()
    {
        $genres = $this->model->getGenres();
        $this->view->showGenres($genres);
    }
    public function showGenre($id)
    {
        $genre = $this->model->getGenre($id);
        $this->view->showGenre($genre);
    }

    function showFilmsByDirector($directorID) {
        $director = $this->model->getDirectorById($directorID);
        if (!$director) {
            $this->view->showError("Director no es valido.");
            return;
        }
        $peliculas = $this->model->getFilmsByDirector($directorID);
        $this->view->showFilmsByDirector($peliculas, $director);
    }
}