<?php
    require_once 'app/controllers/director.controller.php';
    require_once 'app/models/director.model.php';
    class directorView {

        public function showDirectors($directores) {
            require_once 'templates/form.add.director.phtml';
            echo "<h1> Lista de directores </h1>";
            echo "<ul>";

            foreach ($directores as $director) {
                echo "<li>";
                echo $director->nombre;
                echo "<a href='verPeliculasDirector/". $director->id . "'>Ver películas</a>";
                echo "<a href='eliminarDirector/" . $director->id . "'>Borrar</a>";
                echo "</li>";
            }
            
            echo "</ul>";
        }

        public function showError($error) {
            require 'templates/error.phtml';
        }
    
    }