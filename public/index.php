<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controller/task_controller.php';
require_once __DIR__ . '/../controller/user_controller.php';

// Actions publiques qui ne nécessitent pas d'authentification
$public_actions = ['login', 'register'];
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Vérification de l'authentification
if (!isset($_SESSION['id_user']) && !in_array($action, $public_actions)) {
    header('Location: /workshop/view/login.php');
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

$taskController = new TaskController();
$userController = new UserController();

switch ($action) {
    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'create':
        $taskController->create();
        break;
    case 'edit':
        if ($id) $taskController->edit($id);
        break;
    case 'delete':
        if ($id) $taskController->delete($id);
        break;
    case 'toggleActif':   
        if ($id) $taskController->toggleActif($id);
        break;
    case 'details':
        if ($id) $taskController->details($id);
        break;
    case 'updateStatus':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskController->updateStatus();
        }
        break;
    case 'resetRepeatTask':
        $taskController->resetRepeatTask();
        break; 
    case 'getTasksForMonth':
        $month = isset($_GET['month']) ? (int) $_GET['month'] : date('m');
        $year = isset($_GET['year']) ? (int) $_GET['year'] : date('Y');
        $taskController->getTasksForMonth($month, $year);
        break;
    case 'edit_user':   
         if ($id) $userController->edit_user($id);
         break;
    case 'changeRole': 
        if ($id_user) $userController->changeRole($id_user);
        break;
    case 'profile':
        $userController->getProfile();
        break;
    case 'details_user':
        if ($id_user) $userController->details_user($id_user);
        break;
    case 'delete_account':
        if ($id_user) $userController->delete_account($id_user);
        break;
    case 'list_users':
         $userController->getAllUsers();
        break;
    default:
        $taskController->index();
}

exit();


