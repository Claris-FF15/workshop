<?php
require_once __DIR__ . '/../model/task_model.php';
require_once __DIR__ . '/../config/database.php';

class TaskController {
    private $db;
    public $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
    }

    public function index() {
        $user_id = $_SESSION['id_user'];
        $query = "SELECT * FROM tbl_task WHERE id_user = :id_user ORDER BY end_time_task ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id_user' => $user_id]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        require_once __DIR__ . '/../view/index.php';
    }

    public function create() {
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['id_user'])) {
            $this->task->id_user = $_SESSION['id_user'];
        } else {
            echo "Erreur : l'utilisateur n'est pas connecté.";
            return;
        }
    
        // Récupérer les données du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->task->name_task = $_POST['task'] ?? '';
            $this->task->details_task = $_POST['details_task'] ?? '';
            $this->task->important_task = isset($_POST['important_task']) ? 1 : 0;
            $this->task->repeat_task = isset($_POST['repeat_task']) ? 1 : 0;
            $this->task->end_time_task = $_POST['end_time_task'] ?? null;
    

            if ($this->task->create()) {
                header('Location: ../public/index.php');
                exit();
            } else {
                echo "Erreur lors de la création de la tâche.";
            }
        }
    

        require_once __DIR__.'/../view/create.php';
    }
    

    public function toggleActif($id) {
        $query = "SELECT statut_task FROM tbl_task WHERE id = :id_task";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id_task", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            $newStatut = ($task['statut_task'] == 1) ? 0 : 1;

            $updateQuery = "UPDATE tbl_task SET statut_task = :statut_task WHERE id = :id_task";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(":statut_task", $newStatut, PDO::PARAM_INT);
            $updateStmt->bindParam(":id_task", $id, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                header('Location: ../public/index.php');
                exit();
            } else {
                echo "Erreur lors de la mise à jour de l'état du statut.";
            }
        } else {
            echo "Tâche introuvable.";
        }
    }
    public function getTasksForMonth($month, $year) {
        try {
            $query = "SELECT id_task, name_task, details_task, DAY(end_time_task) AS day 
                      FROM tbl_task 
                      WHERE MONTH(end_time_task) = :month 
                      AND YEAR(end_time_task) = :year 
                      AND repeat_task = 0"; // Exclude repeat tasks
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':month', $month, PDO::PARAM_INT);
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tasks);
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo json_encode([]);
        }
    }
    
    

    public function details($id_task) {
        $query = "SELECT id_task, name_task, details_task, important_task, repeat_task, end_time_task, statut_task 
                  FROM tbl_task WHERE id_task = :id_task"; 
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id_task", $id_task, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            require_once __DIR__.'/../view/details.php';
        } else {
            echo "Tâche introuvable ou vous n'avez pas accès à cette tâche.";
        }
    }
    

    public function edit($id_task) {
        $task = $this->task->getTaskById($id_task);

        if (!$task) {
            echo "Tâche introuvable.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskData = [
                'id_task' => $id_task,
                'name_task' => $_POST['name_task'] ?? '',
                'details_task' => $_POST['details_task'] ?? '',
                'important_task' => isset($_POST['important_task']) ? 1 : 0,
                'repeat_task' => isset($_POST['repeat_task']) ? 1 : 0,
                'end_time_task' => $_POST['end_time_task'] ?? null,
                'statut_task' => $_POST['statut_task'] ?? 0
            ];

            if ($this->task->updateTask($taskData)) {
                header('Location: ../public/index.php');
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la tâche.";
            }
        }

        require_once __DIR__.'/../view/edit.php';
    }
    
    public function archive() {
        if (!isset($_SESSION['id_user'])) {
            header('Location: /workshop/view/login.php');
            exit();
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        
        $result = $this->task->getArchivedTasks($_SESSION['id_user'], $page);
        
        if ($result) {
            error_log("Retrieved " . count($result['tasks']) . " archived tasks"); // Debug log
            require_once __DIR__ . '/../view/archive.php';
        } else {
            echo "Erreur lors de la récupération des tâches archivées.";
        }
    }

    public function updateStatus() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_task'], $_POST['statut_task'])) {
                // Log pour debug
                error_log("Tentative de mise à jour - ID: " . $_POST['id_task'] . ", Status: " . $_POST['statut_task']);
                
                // Mettre à jour via le modèle
                $result = $this->task->updateStatus($_POST['id_task'], $_POST['statut_task']);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $result]);
                exit;
            }
        } catch (Exception $e) {
            error_log("Erreur updateStatus: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit;
        }
    }

    public function resetRepeatTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->task->resetRepeatTask()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Échec de la réinitialisation des tâches répétitives."]);
            }
            exit();
        }
    }
    
    
    
    
    public function delete($id) {
        $this->task->id_task = $id;

        if ($this->task->delete()) {
            header('Location: ../public/index.php');
            exit();
        } else {
            echo "Erreur lors de la suppression de la tâche.";
        }
    }
}