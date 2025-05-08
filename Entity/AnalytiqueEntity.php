<?php
    class Analytique{

        private $id_analytique;

        private $nom_analytique;
        

        public function getId_analytique()
        {
        
           return $this->id_analytique;
           
        }
        public function setId_analytique($id_analytique){
    
            return  $this->id_analytique=$id_analytique;
    
        }
    
                    
        public function getNom_analytique()
        {
        
           return $this->nom_analytique;
    
        }
        public function setNom_analytique($nom_analytique){
    
            return   $this->nom_analytique=$nom_analytique;
            
        }

    }

?>