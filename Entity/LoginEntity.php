<?php
    class LoginEntity{

        private $id_login;

        private $matricule_agent;
        
        private $username;

        private $password;

        private $role;

        private $statut;

        private $date_creation;
        

        public function getId_login()
        {
        
           return $this->id_login;
           
        }
        public function setId_login($id_login){
    
            return  $this->id_login=$id_login;
    
        }
    
                    
        public function getMatricule_agent()
        {
        
           return $this->matricule_agent;
    
        }
        public function setMatricule_agent($matricule_agent){
    
            return   $this->matricule_agent=$matricule_agent;
            
        }


        public function getUsername()
        {
        
           return $this->username;
    
        }
        public function setUsername($username){
    
            return   $this->username=$username;
            
        }

        public function getPassword()
        {
        
           return $this->password;
    
        }
        public function setPassword($password){
    
            return   $this->password=$password;
            
        }


        public function getRole()
        {
        
           return $this->role;
    
        }
        public function setRole($role){
    
            return   $this->role=$role;
            
        }


        public function getStatut()
        {
        
           return $this->statut;
    
        }
        public function setStatut($statut){
    
            return   $this->statut=$statut;
            
        }

        public function getDate_creation()
        {
        
           return $this->date_creation;
    
        }
        public function setDate_creation($date_creation){
    
            return   $this->date_creation=$date_creation;
            
        }






    }

?>