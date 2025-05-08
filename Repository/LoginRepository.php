<?php
require_once("../Config/serveur.php");

class LoginRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifier si un agent est déjà inscrit
    public function isAgentExists($matricule_agent) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM login WHERE matricule_agent = :matricule_agent");
        $stmt->execute(['matricule_agent' => $matricule_agent]);
        return $stmt->fetchColumn() > 0;
    }

    // Compter le nombre d'administrateurs
    public function countAdmins() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM login WHERE role = 'admin'");
        return $stmt->fetchColumn();
    }

    // Compter le nombre d'utilisateurs
    public function countUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM login WHERE role = 'user'");
        return $stmt->fetchColumn();
    }

    // Insérer un nouveau login
    public function create_login(LoginEntity $login) {
        $sql = "INSERT INTO login (matricule_agent, username, password, role, statut, date_creation) 
                VALUES (:matricule_agent, :username, :password, :role, :statut, :date_creation)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'matricule_agent' => $login->getId_login(),
            'username' => $login->getMatricule_agent(),
            'password' => $login->getPassword(),
            'role' => $login->getRole(),
            'statut' => $login->getStatut(),
            'date_creation' => $login->getDate_creation()
        ]);
    }
}
?>
