<?php
    namespace Models;

    class JobPosition {

        private $id;
        private $career;
        private $description;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getCareer(){
            return $this->career;
        }

        public function setCareer(Career $career){
            $this->career = $career;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->description = $description;
        }
    }


?>