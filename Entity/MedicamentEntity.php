<?php
    class MedicamentEntity{

        private $id_medicament ;

        private $nom_medicament;

        private $type_rembourse;

     

       



        

        public function getId_medicament()
        {
        
           return $this->id_medicament;
           
        }
        public function setId_medicament($id_medicament){
    
            return  $this->id_medicament=$id_medicament;
    
        }
    
                    
        public function getNom_medicament()
        {
        
           return $this->nom_medicament;
    
        }
        public function setNom_medicament($nom_medicament){
    
            return   $this->nom_medicament=$nom_medicament;
            
        }
                   
        public function getType_rembourse()
        {
        
           return $this->type_rembourse;
        }
        public function setType_rembourse($type_rembourse){
    
            return $this->type_rembourse = $type_rembourse;
            
        }

                    
       
        
        
      
        


         

           



    }







?>