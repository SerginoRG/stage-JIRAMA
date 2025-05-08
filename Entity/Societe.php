<?php
    class Societe{

        private $id_societe;

        private $nom_societe;
        

        public function getId_societe()
        {
        
           return $this->id_societe;
           
        }
        public function setId_societe($id_societe){
    
            return  $this->id_societe=$id_societe;
    
        }
    
                    
        public function getNom_societe()
        {
        
           return $this->nom_societe;
    
        }
        public function setNom_societe($nom_societe){
    
            return   $this->nom_societe=$nom_societe;
            
        }

    }

?>