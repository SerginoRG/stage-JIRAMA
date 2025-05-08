<?php


require_once("../Config/serveur.php");
$db = new Db(); 
$pdo = $db->connexion();



// $password = md5($_POST['password']); // You may want to use password_hash for better security


try {
    // Récupérer et valider les entrées utilisateur
    $matricule_agent = $_POST['matricule_agent'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Laisser tel quel pour hashage ultérieur
    $role = $_POST['role'];
    $statut = $_POST['statut'];
    $date_creation = $_POST['date_creation'];

   // Vérifiez que l'agent n'existe pas déjà
   $checkAgent = $pdo->prepare("SELECT COUNT(*) FROM login WHERE matricule_agent = :matricule_agent");
   $checkAgent->execute(['matricule_agent' => $matricule_agent]);

   if ($checkAgent->fetchColumn() > 0) {
       throw new Exception("Cet agent est déjà inscrit !");
   }

   // Insérez le nouvel utilisateur
   $insertQuery = $pdo->prepare("
       INSERT INTO login (matricule_agent, username, password, role, statut, date_creation) 
       VALUES (:matricule_agent, :username, :password, :role, :statut, :date_creation)
   ");
   $insertResult = $insertQuery->execute([
       'matricule_agent' => $matricule_agent,
       'username' => $username,
       'password' => password_hash($password, PASSWORD_BCRYPT),
       'role' => $role,
       'statut' => $statut,
       'date_creation' => $date_creation,
   ]);

   if ($insertResult) {
       // Succès : Redirection avec un message de succès
       header("Location: ../PageAdiminstrateur/Admin.php?success=1");
       exit;
   } else {
       throw new Exception("Erreur : Impossible de créer le compte.");
   }
} catch (Exception $e) {
   // Erreur : Redirection avec le message d'erreur encodé
   header("Location: ../PageAdiminstrateur/Admin.php?error=" . urlencode($e->getMessage()));
   exit;
}
























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
