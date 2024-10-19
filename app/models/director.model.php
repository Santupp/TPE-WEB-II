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
        $query = $this->db->prepare('SELECT * FROM directores');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function insertDirector($nombre) {

        $filePath = "images/" . uniqid("", true) . "." . strtolower(pathinfo($_FILES['input_name']['name'], PATHINFO_EXTENSION));

        move_uploaded_file($_FILES['input_name']['tmp_name'], $filePath);

        $query = $this->db->prepare('INSERT INTO directores (nombre, imagen) VALUES (?, ?)');
        $query->execute([$nombre, $filePath]);

        $id = $this->db->lastInsertId();

        return $id;
    }
    
    public function deleteDirector($id) {
        $query = $this->db->prepare('DELETE FROM directores WHERE id = ?');
        $query->execute([$id]);
    }

    function getDirector($id) {
        $query = $this->db->prepare('SELECT * FROM directores WHERE id = ?');
        $query->execute([$id]);

        $task = $query->fetch(PDO::FETCH_OBJ);

        return $task;
    }

    public function saveDirector($nombre, $fileTemp = null) {
        // Inicializa la ruta de la imagen
        $rutaImagen = null;

        // Si se proporciona un archivo temporal, moverlo
        if ($fileTemp) {
            $rutaDestino = 'images/'; // Ruta de la carpeta donde se guardan las imágenes
            $nombreArchivo = basename($_FILES['input_name']['name']);
            $rutaImagen = $rutaDestino . $nombreArchivo;

            // Mover el archivo del directorio temporal al directorio de destino
            if (move_uploaded_file($fileTemp, $rutaImagen)) {
                // El archivo se ha movido con éxito
            } else {
                // Manejo de error si el archivo no se puede mover
                throw new Exception('Error al mover la imagen.');
            }
        }

        // Guardar el director en la base de datos con la ruta de la imagen
        $sql = "INSERT INTO directores (nombre, imagen) VALUES (:nombre, :imagen)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':imagen', $rutaImagen); // Guardar la ruta de la imagen (o NULL si no se proporcionó)
        $stmt->execute();
    }
}
