<?php
    class TypeHospitalisationEntity{

        private $id_type_hospitalisation;

        private $nom_hospitalisation;

        private $plafond ;

     

       



        

        public function getId_type_hospitalisation()
        {
        
           return $this->id_type_hospitalisation;
           
        }
        public function setId_type_hospitalisation($id_type_hospitalisation){
    
            return  $this->id_type_hospitalisation=$id_type_hospitalisation;
    
        }
    
                    
        public function getNom_hospitalisation()
        {
        
           return $this->nom_hospitalisation;
    
        }
        public function setNom_hospitalisation($nom_hospitalisation){
    
            return   $this->nom_hospitalisation=$nom_hospitalisation;
            
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