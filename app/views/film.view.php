<?php

class FilmView
{
    private $user = null;

    public function showFilms($films)
    {

        require 'templates/films.phtml';
    }

    public function showGenres($genres)
    {
        require 'templates/genres.phtml';
    }
    public function addFilm()
    {
        require 'templates/addFilms.phtml';
    }

    public function showHome()
    {
        require 'templates/home.phtml';
    }


}