<?php
    class Facture{

        private $id_facture;

        private $id_remboursement;

        private $id_analytique;

       

        private $numero_facture;

        private $date_facture;


        private $remarque;

        private $id_medicament;

        private $quantite;

        private $categorie;

        private $prix_unitaire;


        public function getPrix_unitaire()
        {
        
           return $this->prix_unitaire;
           
        }
        public function setPrix_unitaire($prix_unitaire){
    
            return  $this->prix_unitaire=$prix_unitaire;
    
        }

        public function getCategorie()
        {
        
           return $this->categorie;
           
        }
        public function setCategorie($categorie){
    
            return  $this->categorie=$categorie;
    
        }


        public function getQuantite()
        {
        
           return $this->quantite;
           
        }
        public function setQuantite($quantite){
    
            return  $this->quantite=$quantite;
    
        }

        public function getId_medicament()
        {
        
           return $this->id_medicament;
           
        }
        public function setId_medicament($id_medicament){
    
            return  $this->id_medicament=$id_medicament;
    
        }
        

        public function getId_facture()
        {
        
           return $this->id_facture;
           
        }
        public function setId_facture($id_facture){
    
            return  $this->id_facture=$id_facture;
    
        }
    
                    
        public function getId_remboursement()
        {
        
           return $this->id_remboursement;
    
        }
        public function setId_remboursement($id_remboursement){
    
            return   $this->id_remboursement=$id_remboursement;
            
        }


        public function getId_analytique(){
            return $this->id_analytique;
        }
        public function setId_analytique($id_analytique){
            return $this->id_analytique=$id_analytique;
        }

        
        
        public function getNumero_facture()
        {
        
           return $this->numero_facture;
           
        }
        public function setNumero_facture($numero_facture){
            
            return   $this->numero_facture=$numero_facture;
            
        }


        public function getDate_facture()
        {
            
            return $this->date_facture;
            
        }
        public function setDate_facture($date_facture){
            
            return   $this->date_facture=$date_facture;
            
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