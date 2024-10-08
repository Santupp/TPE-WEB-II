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

}