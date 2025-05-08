<?php
    class TypeConsultationEntity{

        private $id_type_consultation ;

        private $nom_consultation;

        private $plafond;

     

       



        

        public function getId_type_consultation()
        {
        
           return $this->id_type_consultation;
           
        }
        public function setId_type_consultation($id_type_consultation){
    
            return  $this->id_type_consultation=$id_type_consultation;
    
        }
    
                    
        public function getNom_consultation()
        {
        
           return $this->nom_consultation;
    
        }
        public function setNom_consultation($nom_consultation){
    
            return   $this->nom_consultation=$nom_consultation;
            
        }
                   
        public function getPlafond()
        {
        
           return $this->plafond;
        }
        public function setPlafond($plafond){
    
            return $this->plafond = $plafond;
            
        }

                    
       
        
        
      
        


         

           



    }







?>