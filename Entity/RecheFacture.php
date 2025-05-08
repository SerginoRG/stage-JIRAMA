<?php
    class Rechercher{

        private $date_debut;

        private $date_fin;

       
        

        public function getDate_debut()
        {
        
           return $this->date_debut;
           
        }
        public function setDate_debut($date_debut){
    
            return  $this->date_debut=$date_debut;
    
        }
    
                    
        public function getDate_fin()
        {
        
           return $this->date_fin;
    
        }
        public function setDate_fin($date_fin){
    
            return   $this->date_fin=$date_fin;
            
        }


       


      
       

    }

?>