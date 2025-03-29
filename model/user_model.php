<?php
class User {
    private $conn;
    private $table_name = "tbl_user";
    public $id_user;
    public $username;
    public $mail;
    public $password;
    public $password_hash;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $mail, $password) {
        try {
            // Vérifier si l'utilisateur existe déjà
            $check = "SELECT id_user FROM tbl_user WHERE username = :username OR mail = :mail";
            $stmt = $this->conn->prepare($check);
            $stmt->execute([':username' => $username, ':mail' => $mail]);
            
            if ($stmt->rowCount() > 0) {
                return false;
            }
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tbl_user (username, mail, password) VALUES (:username, :mail, :password)";
            $stmt = $this->conn->prepare($sql);
            
            return $stmt->execute([
                ':username' => $username,
                ':mail' => $mail,
                ':password' => $passwordHash
            ]);
        } catch (PDOException $e) {
            error_log("Register error: " . $e->getMessage());
            return false;
        }
    }

    public function login($username, $password) {
        try {
            $query = "SELECT * FROM tbl_user WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Login attempt - Username: $username, User found: " . ($user ? 'yes' : 'no'));
            
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($id_user) {
        $sql = "SELECT * FROM tbl_user WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_user, $username, $mail, $password = null) {
        if ($password) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tbl_user SET username = :username, mail = :mail, password = :password WHERE id_user = :id_user";
            $params = [
                ':id_user' => $id_user,
                ':username' => $username,
                ':mail' => $mail,
                ':password' => $passwordHash
            ];
        } else {
            $sql = "UPDATE tbl_user SET username = :username, mail = :mail WHERE id_user = :id_user";
            $params = [
                ':id_user' => $id_user,
                ':username' => $username,
                ':mail' => $mail
            ];
        }
    
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
    
    public function delete($id_user) {
        $sql = "DELETE FROM tbl_user WHERE id = :id_user";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id_user' => $id_user]);
    }
    

   public function read (){
    $query = "SELECT id_user, username, mail, role FROM". $this->table_name;

    $stmt = $this ->conn ->prepare($query);
    $stmt-> execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

   }

    public function saveRememberToken($userId, $token) {
        $query = "UPDATE tbl_user SET remember_token = :token WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':token' => $token,
            ':id_user' => $userId
        ]);
    }

    public function getUserByRememberToken($token) {
        $query = "SELECT id_user FROM tbl_user WHERE remember_token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeRememberToken($userId) {
        $query = "UPDATE tbl_user SET remember_token = NULL WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id_user' => $userId]);
    }
}

