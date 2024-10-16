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

    public function showFilmsByDirector($peliculas, $director) {
        echo "<h1> Peliculas de " . $director->nombre . " </h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Título</th><th>Género</th></tr>";
        foreach ($peliculas as $pelicula) {
            echo "<tr>";
            echo "<td>" . $pelicula->id . "</td>";
            echo "<td>" . $pelicula->nombre . "</td>";
            echo "<td>" . $pelicula->genero . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function showError($error) {
        echo "<h2>Error: $error</h2>";
    }

}