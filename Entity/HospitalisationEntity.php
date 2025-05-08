<?php
    class HospitalisationEntity{

        private $id_hospitalisation;

        private $id_demande;

        private $id_type_hospitalisation;

        private $numero_piece;

        private $date_admission;

        private $date_sortie;

        private $frais_hospitalisation;

        private $lieu_hospitalisation;

        private $remarque;
        

        public function getIdhospitalisation()
        {
        
           return $this->id_hospitalisation;
           
        }
        public function setIdhospitalisation($id_hospitalisation){
    
            return  $this->id_hospitalisation = $id_hospitalisation;
    
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



        public function getId_type_hospitalisation()
        {
        
           return $this->id_type_hospitalisation;
    
        }
        public function setId_type_hospitalisation($id_type_hospitalisation){
    
            return   $this->id_type_hospitalisation=$id_type_hospitalisation;
            
        }



        public function getDate_admission()
        {
        
           return $this->date_admission;
    
        }
        public function setDate_admission($date_admission){
    
            return   $this->date_admission=$date_admission;
            
        }


        public function getDate_sortie()
        {
        
           return $this->date_sortie;
        }
        public function setDate_sortie($date_sortie){
    
            return   $this->date_sortie=$date_sortie;
            
        }

        public function getFrais_hospitalisation()
        {
        
           return $this->frais_hospitalisation;
    
        }
        public function setFrais_hospitalisation($frais_hospitalisation){
    
            return   $this->frais_hospitalisation=$frais_hospitalisation;
            
        }


        public function getLieu_hospitalisation()
        {
        
           return $this->lieu_hospitalisation;
    
        }
        public function setLieu_hospitalisation($lieu_hospitalisation){
    
            return   $this->lieu_hospitalisation=$lieu_hospitalisation;
            
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