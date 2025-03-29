<?php

class Task {
    private $conn;
    private $table_name = "tbl_task";
    public $id_task;
    public $id_user;
    public $name_task;
    public $details_task;
    public $important_task;
    public $repeat_task;
    public $add_time_task;
    public $end_time_task;
    public $statut_task;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $sql = "INSERT INTO tbl_task (id_user, name_task, details_task, important_task, repeat_task, end_time_task) 
                VALUES (:id_user, :name_task, :details_task, :important_task, :repeat_task, :end_time_task)";
    
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':id_user' => $this->id_user,
            ':name_task' => $this->name_task,
            ':details_task' => $this->details_task,
            ':important_task' => $this->important_task,
            ':repeat_task' => $this->repeat_task,
            ':end_time_task' => $this->end_time_task
        ]);
    }
    

    public function read() {
        $query = "SELECT id_task, name_task, details_task, important_task, repeat_task, add_time_task, end_time_task, statut_task 
                  FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskById($id_task) {
        $query = "SELECT id_task, id_user, name_task, details_task, important_task, repeat_task, end_time_task, statut_task 
                  FROM tbl_task WHERE id_task = :id_task";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_task", $id_task, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function updateTask($taskData) {
        $query = "UPDATE tbl_task 
                  SET name_task = :name_task, 
                      details_task = :details_task, 
                      important_task = :important_task, 
                      repeat_task = :repeat_task, 
                      end_time_task = :end_time_task, 
                      statut_task = :statut_task 
                  WHERE id_task = :id_task";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_task", $taskData['id_task'], PDO::PARAM_INT);
        $stmt->bindParam(":name_task", $taskData['name_task']);
        $stmt->bindParam(":details_task", $taskData['details_task']);
        $stmt->bindParam(":important_task", $taskData['important_task'], PDO::PARAM_INT);
        $stmt->bindParam(":repeat_task", $taskData['repeat_task'], PDO::PARAM_INT);
        $stmt->bindParam(":end_time_task", $taskData['end_time_task']);
        $stmt->bindParam(":statut_task", $taskData['statut_task'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updateStatus($id_task, $statut_task) {
        try {
            $query = "UPDATE tbl_task SET statut_task = :statut_task WHERE id_task = :id_task";
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindValue(':id_task', $id_task, PDO::PARAM_INT);
            $stmt->bindValue(':statut_task', $statut_task, PDO::PARAM_INT);
            
            // Log pour debug
            error_log("Exécution de la requête SQL - ID: $id_task, Status: $statut_task");
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur SQL updateStatus: " . $e->getMessage());
            throw $e;
        }
    }

    public function getArchivedTasks($userId, $page = 1, $perPage = 10) {
        try {
            $offset = ($page - 1) * $perPage;
            
            // Requête modifiée pour inclure toutes les colonnes nécessaires
            $query = "SELECT id_task, name_task, details_task, important_task, end_time_task, statut_task 
                     FROM " . $this->table_name . " 
                     WHERE id_user = :user_id 
                     AND repeat_task = 0 
                     AND statut_task = 1 
                     ORDER BY end_time_task DESC 
                     LIMIT :limit OFFSET :offset";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Compter le total des tâches
            $countQuery = "SELECT COUNT(*) FROM " . $this->table_name . " 
                          WHERE id_user = :user_id 
                          AND repeat_task = 0 
                          AND statut_task = 1";
            
            $countStmt = $this->conn->prepare($countQuery);
            $countStmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $countStmt->execute();
            $totalTasks = $countStmt->fetchColumn();
            
            error_log("Archived tasks found: " . count($tasks)); // Debug log
            
            return [
                'tasks' => $tasks,
                'totalTasks' => $totalTasks,
                'totalPages' => ceil($totalTasks / $perPage),
                'currentPage' => $page
            ];
        } catch (PDOException $e) {
            error_log("Error in getArchivedTasks: " . $e->getMessage());
            return ['tasks' => [], 'totalTasks' => 0, 'totalPages' => 0, 'currentPage' => 1];
        }
    }

    public function getTasksForMonth($month, $year) {
        $query = "SELECT id_task, name_task, DAY(end_time_task) AS day 
                  FROM tbl_task 
                  WHERE MONTH(end_time_task) = :month AND YEAR(end_time_task) = :year";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":month", $month, PDO::PARAM_INT);
        $stmt->bindParam(":year", $year, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function resetRepeatTask() {
        $query = "UPDATE tbl_task SET statut_task = 0 WHERE repeat_task = 1"; // Réinitialise toutes les tâches répétitives
        $stmt = $this->conn->prepare($query);
        
        // Vérification de la préparation de la requête
        if (!$stmt) {
            error_log("Erreur de préparation de la requête : " . $this->conn->error);
            echo json_encode(["success" => false, "message" => "Erreur de préparation de la requête"]);
            exit();
        }
    
        // Exécution de la requête
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
            exit();
        } else {
            error_log("Erreur lors de l'exécution de la requête : " . $stmt->error);
            echo json_encode(["success" => false, "message" => "Erreur lors de l'exécution de la requête"]);
            exit();
        }
    }
    

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_task = :id_task";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_task", $this->id_task, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
