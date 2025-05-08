<?php
    class Agent{

        private $matriculeAgent;
        
        private $nom_agent;

        private $prenom_agent;

        private $id_societe;

        private $adresse_agent;

        private $sexe_agent;

        private $compte_bancaire;
        
       
        
        private $statut;
        
        private $telephone;
        
        
        
        public function getMatriculeAgent()
        {
        
           return $this->matriculeAgent;
        }
        public function setMatriculeAgent($matriculeAgent){
    
            return $this->matriculeAgent = $matriculeAgent;
            
        }
        
        // nom Employe
        public function getNomAgent()
        {
        
           return $this->nom_agent;
    
        }
        public function setNomAgent($nom_agent){
    
            return   $this->nom_agent=$nom_agent;
            
        }
                    // prenom Employe
        public function getPrenomAgent()
        {
        
           return $this->prenom_agent;
        }
        public function setPrenomAgent($prenom_agent){
    
            return $this->prenom_agent = $prenom_agent;
            
        }

                    // societe Employe
        public function getIdSociete()
        {
        
           return $this->id_societe;
        }
        public function setIdSociete($id_societe){
    
            return $this->id_societe = $id_societe;
            
        }
        
        // adresseEmploye
        public function getAdresseAgent()
        {
            
            return $this->adresse_agent;
        }
        public function setAdresseAgent($adresse_agent){
            
            return $this->adresse_agent = $adresse_agent;
            
        }
        // sexe Employe
        public function getSexeAgent()
        {
        
           return $this->sexe_agent;
        }
        public function setSexeAgent($sexe_agent){
    
            return $this->sexe_agent = $sexe_agent;
            
        }

    
        
        // numero_compte_Employe
        public function getNumero_compte_Agent()
        {
        
           return $this->compte_bancaire;
        }
        public function setNumero_compte_Agent($compte_bancaire){
    
            return $this->compte_bancaire = $compte_bancaire;
            
        }


   

         public function getStatut()
          {
          
             return $this->statut;
             
          }
          public function setStatut($statut){
      
              return  $this->statut=$statut;
      
          }

           
         
          

          public function getTelephone()
          {
          
             return $this->telephone;
             
          }
          public function setTelephone($telephone){
      
              return  $this->telephone=$telephone;
      
          }
      



    }







?>