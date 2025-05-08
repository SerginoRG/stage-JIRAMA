<?php
    class Paiement{

        private $id_paiement;

        private $id_remboursement;

        private $mode_paiement;

        private $date_paiement;

       



        

        public function getId_paiement()
        {
        
           return $this->id_paiement;
           
        }
        public function setId_paiement($id_paiement){
    
            return  $this->id_paiement=$id_paiement;
    
        }
    
                    
        public function getId_remboursement()
        {
        
           return $this->id_remboursement;
    
        }
        public function setId_remboursement($id_remboursement){
    
            return   $this->id_remboursement=$id_remboursement;
            
        }
                   
        public function getMode_paiement()
        {
        
           return $this->mode_paiement;
        }
        public function setMode_paiement($mode_paiement){
    
            return $this->mode_paiement = $mode_paiement;
            
        }

                    
        public function getDate_paiement()
        {
        
           return $this->date_paiement;
        }
        public function setDate_paiement($date_paiement){
    
            return $this->date_paiement = $date_paiement;
            
        }
        
        
      
        


         

           



    }







?>