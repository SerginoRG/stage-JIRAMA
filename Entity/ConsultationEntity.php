<?php
    class ConsultationEntity{

        private $id_consultation;

        private $id_demande;

        private $type_consultation;

        private $numero_piece;

        private $date_consultation;


        private $motif;

        private $frais_consultation;

        private $lieu_consultation;

        private $remarque;
        

        public function getIdconsultation()
        {
        
           return $this->id_consultation;
           
        }
        public function setIdconsultation($id_consultation){
    
            return  $this->id_consultation = $id_consultation;
    
        }

        public function getNumero_piece()
        {
        
           return $this->numero_piece;
           
        }
        public function setNumero_piece($numero_piece){
    
            return  $this->numero_piece = $numero_piece;
    
        }
    
                    
        public function getIddemande()
        {
        
           return $this->id_demande;
    
        }
        public function setIddemande($id_demande){
    
            return   $this->id_demande=$id_demande;
            
        }



        public function getType_consultation()
        {
        
           return $this->type_consultation;
    
        }
        public function setType_consultation($type_consultation){
    
            return   $this->type_consultation=$type_consultation;
            
        }



        public function getDate_consultation()
        {
        
           return $this->date_consultation;
    
        }
        public function setDate_consultation($date_consultation){
    
            return   $this->date_consultation=$date_consultation;
            
        }


        public function getMotif()
        {
        
           return $this->motif;
    
        }
        public function setMotif($motif){
    
            return   $this->motif=$motif;
            
        }


        public function getFrais_consultation()
        {
        
           return $this->frais_consultation;
    
        }
        public function setFrais_consultation($frais_consultation){
    
            return   $this->frais_consultation=$frais_consultation;
            
        }


        public function getLieu_consultation()
        {
        
           return $this->lieu_consultation;
    
        }
        public function setLieu_consultation($lieu_consultation){
    
            return   $this->lieu_consultation=$lieu_consultation;
            
        }


        public function getRemarque()
        {
        
           return $this->remarque;
    
        }
        public function setRemarque($remarque){
    
            return   $this->remarque=$remarque;
            
        }


    }

?>