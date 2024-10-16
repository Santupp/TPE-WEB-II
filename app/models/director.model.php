<?php
require_once 'app/controllers/director.controller.php';
require_once 'app/views/director.view.php';
class directorModel
{
    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe;charset=utf8', 'root', '');
    }

    function getDirectors() {
        $query = $this->db->prepare('SELECT * FROM director');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    function insertDirector($nombre) {
        $query = $this->db->prepare('INSERT INTO director (nombre) VALUES (?)');
        $query->execute([$nombre]);

        $id = $this->db->lastInsertId();

        return $id;
    }
    public function deleteDirector($id) {
        $query = $this->db->prepare('DELETE FROM director WHERE id = ?');
        $query->execute([$id]);
    }

    function getDirector($id) {
        $query = $this->db->prepare('SELECT * FROM directores WHERE id = ?');
        $query->execute([$id]);

        $task = $query->fetch(PDO::FETCH_OBJ);

        return $task;
    }
}
