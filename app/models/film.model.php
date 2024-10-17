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
        $sql = "INSERT INTO peliculas (nombre, fecha_estreno, genero) VALUES (null ,?, ?, ?, null, null)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $estreno);
        $stmt->bindParam(3, $genero);

        if ($stmt->execute()) {
            echo "hi";

            return true;
        } else {
            echo "hi";
            return false;
        }
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

}