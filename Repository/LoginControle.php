<?php
require_once("../Config/serveur.php");
require_once("../Entity/LoginEntity.php");

class loginControle_Affiche{

    
    
    public function read_controle_Affiche(){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM login  ");
    
        $af = array();
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
            $af[]= array($key["matricule_agent"],$key["username"],$key["role"],$key["statut"],$key["date_creation"]);
        }
    return $af;
    
    }
    public function delete_controle_Affiche(LoginEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" DELETE FROM login WHERE matricule_agent = '".$i->getMatricule_agent()."' ");
      
    
    }
    public function update_controle_Affiche(LoginEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" UPDATE login SET username = '".$i->getUsername()."',role = '".$i->getRole()."' ,statut = '".$i->getStatut()."'    WHERE  matricule_agent = '".$i->getMatricule_agent()."'  ");
      
    } 

    public function PasswordAdmin(LoginEntity $i) {
      $db = new Db();
      $pdo = $db->connexion();
  
      // Hashage du mot de passe avant l'insertion
      $hashedPassword = password_hash($i->getPassword(), PASSWORD_BCRYPT);
  
      $stmt = $pdo->prepare("UPDATE login SET password = :password WHERE matricule_agent = :matricule_agent");
      $stmt->execute([
          'password' => $hashedPassword, // On enregistre le mot de passe hashé
          'matricule_agent' => $i->getMatricule_agent()
      ]);
  }
  
  
    
    }
    
?>
