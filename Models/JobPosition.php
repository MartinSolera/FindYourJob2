<?php
    namespace Models;

    class JobPosition {

        private $id;
        private $careerId;
        private $description;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getCareerId(){
            return $this->careerId;
        }

        public function setCareerId($careerId){
            $this->careerId = $careerId;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->description = $description;
        }
    }


?>