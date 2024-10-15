<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['ID_USER'])){
            foreach ($_SESSION as $key => $value) {
                $res->$key = $value;
            }
            $res->user = new stdClass();
            $res->user->id = $_SESSION['ID_USER'];
            $res->user->email = $_SESSION['EMAIL_USER'];
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }
?>