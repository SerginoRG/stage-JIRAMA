<?php
    class Cms{

        private $id_cms;

        private $matricule_agent;

        private $nom_cms;

        private $role_agent;
        

        public function getId_cms()
        {
        
           return $this->id_cms;
           
        }
        public function setId_cms($id_cms){
    
            return  $this->id_cms=$id_cms;
    
        }
    
                    
        public function getMatricule_agentCMS()
        {
        
           return $this->matricule_agent;
    
        }
        public function setMatricule_agentCMS($matricule_agent){
    
            return   $this->matricule_agent=$matricule_agent;
            
        }
                   
        public function getNom_cms()
        {
        
           return $this->nom_cms;
        }
        public function setNom_cms($nom_cms){
    
            return $this->nom_cms = $nom_cms;
            
        }

                    
        public function getRole_cms()
        {
        
           return $this->role_agent;
        }
        public function setRole_cms($role_agent){
    
            return $this->role_agent = $role_agent;
            
        }
        
        
      
        


         

           



    }







?>