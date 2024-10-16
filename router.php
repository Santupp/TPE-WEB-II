<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/controllers/film.controller.php';
//require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/auth.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'peliculas'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// listar  -> TaskController->showTask();
// nueva  -> TaskController->addTask();
// eliminar/:ID  -> TaskController->deleteTask($id);
// finalizar/:ID -> TaskController->finishTask($id);
// ver/:ID -> TaskController->view($id); COMPLETAR

// verDirectores  -> directorController->showDirectores();
// verPeliculasDirector  -> filmController->showFilmsByDirector($directorId);
// agregarDirector  -> directorController->addDirector;
// eliminarDirector/:ID -> deleteDirector($id)

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);
switch ($params[0]) {
    case 'peliculas':
        sessionAuthMiddleware($res);
        $controller = new FilmController();
        $controller->showFilms();
        break;
    case 'nueva':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new TaskController($res);
        $controller->addTask();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login

        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'agregarPelicula':
        sessionAuthMiddleware($res);
        $controller = new FilmController();
        $controller->addFilms();
        break;
        case 'verDirectores':
            $controller = new directorController();
            $controller->showDirectors();
            break;
        case 'verPeliculasDirector':
            if (isset($params[1])) {
                $controller = new filmController();
                $controller->showFilmsByDirector($params[1]); // Usar el segundo parámetro como el ID del director
            } else {
                //falta controlar error
            }
            break;
        case 'agregarDirector':
            $controller = new directorController();
            $controller->addDirector();
            break;
        case 'eliminarDirector':
            if (isset($params[1])) {
                $controller = new directorController();
                $controller->deleteDirector($params[1]);
            } else {
                //falta controlar error
            }
            break;
    default:
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
