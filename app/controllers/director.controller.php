<?php
    require_once 'app/models/director.model.php';
    require_once 'app/views/director.view.php';

    class directorController {

        private $model;
        private $view;

        public function __construct() {
            $this->model = new directorModel();
            $this->view = new directorView();
        }

        function showDirectors() {
            $directores = $this->model->getDirectors();
            $this->view->showDirectors($directores);
        }

        public function addDirector() {
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) { 
                return $this->view->showError('Falta completar el nombre');
            }
            $nombre = $_POST['nombre'];;
            
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                //si la imagen es valida llama al metodo para guardar la ruta temporal de la imagen junto al director
                $id = $this->model->insertDirector($nombre, $_FILES['imagen']['tmp_name']);
            }
            else {
                $id = $this->model->insertDirector($nombre);
            }

            header('Location: ' . BASE_URL . 'verDirectores');
        }

        public function deleteDirector($id) {
            $director = $this->model->getDirector($id);
            if (!$director) {
                return $this->view->showError("No existe el director con id= $id");
            }
            $this->model->deleteDirector($id);
            header('Location: ' . BASE_URL . 'verDirectores');
        }
        public function addImage() {
        }
    }
