<?php
require_once 'config.db.php';
class FilmModel extends ConfigModel
{


    public function getFilms()
    {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getFilm($id)
    {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);

    }
    public function addFilm($nombre, $estreno, $genero) {

        $filePath = "images/" . uniqid("", true) . "." . strtolower(pathinfo($_FILES['input_name']['name'], PATHINFO_EXTENSION));
        move_uploaded_file($_FILES['input_name']['tmp_name'], $filePath);

        $query = $this->db->prepare('INSERT INTO peliculas (nombre, fecha_estreno, genero, imagen) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $estreno, $genero ,$filePath]);

        $id = $this->db->lastInsertId();
        return $id;
    }

    function getFilmsByDirector($directorID) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_director = ?');
        $query->execute([$directorID]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getDirectorNameById($directorID) {
        $query = $this->db->prepare('SELECT nombre FROM directores WHERE id = ?');
        $query->execute([$directorID]);
        return $query->fetch(PDO::FETCH_OBJ)->nombre;
    }
    function getDirectorById($directorID) {
        $query = $this->db->prepare('SELECT * FROM directores WHERE id = ?');
        $query->execute([$directorID]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}