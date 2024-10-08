<?php
class FilmModel
{
    private $db;
    public function __construct()
    {
            $this->db = new PDO('mysql:host=localhost;dbname=tpe;charset=utf8', 'root', '');

    }
    public function getFilms()
    {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}