<?php
require_once 'config.db.php';
class FilmModel extends ConfigModel
{
//    private $db;
//    public function __construct()
//    {
//            $this->db = new PDO('mysql:host=localhost;dbname=tpe;charset=utf8', 'root', '');
//
//    }

    public function getFilms()
    {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
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

}