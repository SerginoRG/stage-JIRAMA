<?php
    class Remboursement{

        private $id_remboursement;

        private $matricule_agent;

        private $id_cms;


        private $date_demande;




        

        public function getIdRemboursement()
        {
        
           return $this->id_remboursement;
           
        }
        public function setIdRemboursement($id_remboursement){
    
            return  $this->id_remboursement=$id_remboursement;
    
        }
    
                    
        public function getMatricule_agent()
        {
        
           return $this->matricule_agent;
    
        }
        public function setMatricule_agent($matricule_agent){
    
            return   $this->matricule_agent=$matricule_agent;
            
        }

        public function getid_cmsDemande()
        {
        
           return $this->id_cms;
    
        }
        public function setid_cmsDemande($id_cms){
    
            return   $this->id_cms=$id_cms;
            
        }
                   
        public function getDate_demande()
        {
        
           return $this->date_demande;
        }
        public function setDate_demande($date_demande){
    
            return $this->date_demande = $date_demande;
            
        }

                    
      

           



    }







?>