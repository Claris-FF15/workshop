<?php
require_once __DIR__.'/../model/user_model.php';
require_once __DIR__.'/../config/database.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);  
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $mail = trim($_POST['mail']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                header("Location: /workshop/view/login.php?error=Les mots de passe ne correspondent pas");
                exit();
            }

            if ($this->user->register($username, $mail, $password)) {
                header("Location: /workshop/view/login.php?success=Inscription réussie");
                exit();
            }
            
            header("Location: /workshop/view/login.php?error=Erreur lors de l'inscription");
            exit();
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                header("Location: /workshop/view/login.php?error=Veuillez remplir tous les champs");
                exit();
            }

            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                header("Location: /workshop/public/index.php");
                exit();
            }
            
            header("Location: /workshop/view/login.php?error=Identifiants incorrects");
            exit();
        }
    }

    public function authenticateFromCookie($token) {
        $user = $this->user->getUserByRememberToken($token);
        if ($user) {
            $_SESSION['id_user'] = $user['id_user'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /workshop/view/login.php');
        exit();
    }
    public function getProfile() {
        if (!isset($_SESSION['id_user'])) {
            header('Location: /workshop/view/login.php');
            exit();
        }
    
        $id_user = $_SESSION['id_user'];
        $query = "SELECT id_user, username, mail, role FROM tbl_user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            require_once __DIR__ . '/../view/profile.php';
        } else {
            echo "Utilisateur introuvable.";
        }
    }
    public function details_user($id_user) {
        if (!isset($_SESSION['id_user']) || $_SESSION['id_user'] != $id_user) {
            header('Location: /workshop/public/index.php');
            exit();
        }
        
        $user = $this->user->getUserById($id_user);
        if ($user) {
            require_once __DIR__.'/../view/profile.php';
        } else {
            echo "Utilisateur introuvable.";
        }
    }

    public function delete_account($id_user) {
        if (!isset($_SESSION['id_user']) || $_SESSION['id_user'] != $id_user) {
            header('Location: /workshop/public/index.php');
            exit();
        }

        if ($this->user->delete($id_user)) {
            session_destroy();
            header('Location: /workshop/view/login.php?success=Compte supprimé');
        } else {
            header('Location: /workshop/public/index.php?error=Erreur lors de la suppression');
        }
        exit();
    }

    public function edit_user($id_user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $username = $_POST['username'] ?? '';
            $mail = $_POST['mail'] ?? '';
            $password = $_POST['password'] ?? null;  // Facultatif
    
            // Mise à jour via le modèle
            if ($this->user->update($id_user, $username, $mail, $password)) {
                header('Location: ../public/index.php'); // Redirection vers la page principale
                exit();
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        } else {
            // Si ce n'est pas une requête POST, récupérer l'utilisateur à modifier
            $user = $this->user->getUserById($id_user);
            if (!$user) {
                echo "Utilisateur introuvable.";
                return;
            }
            require_once __DIR__ . '/../view/edit_user.php'; // Affichage du formulaire d'édition
        }
    }
    public function getAllUsers() {
        $users = $this->user->getAllUsersWithoutPassword();
        require_once __DIR__.'/../view/admin.php';
    }
    public function changeRole($id_user) {
        $user = $this->user->getUserRole($id_user);
    
        if ($user) {
            $newRole = ($user['role'] == 1) ? 0 : 1; // Inversion du rôle
            if ($this->user->updateUserRole($id_user, $newRole)) {
                // Réponse JSON pour l'AJAX
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'newRole' => $newRole
                ]);
                exit();
            } else {
                echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour du rôle.']);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Utilisateur introuvable.']);
            exit();
        }
    }
    

    public function index() {
        $users = $this->user->read();
        require_once __DIR__.'/../view/index.php'; 
    }
}

