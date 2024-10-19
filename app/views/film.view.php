<?php

class FilmView
{
    private $user = null;

    public function showFilms($films)
    {
        require 'templates/films.phtml';
    }
    public function showFilm($film)
    {
        require 'templates/film.phtml';
    }

    public function showAddFilmForm($directors) {
        require 'templates/addFilms.phtml';
    }
    public function addFilm()
    {
        require 'templates/addFilms.phtml';
    }




    public function showFilmsByDirector($peliculas, $director) {
        include_once 'templates/films.by.director.phtml';
    }

    function showError($error) {
        echo "<h2>Error: $error</h2>";
    }

}