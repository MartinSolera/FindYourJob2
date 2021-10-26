<?php
    namespace Models;

    class UserType {

        private $id;
        private $description;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setDescription($description){
            $this->description = $description;
        }

        public function getDescription(){
            return $this->description;
        }

    }

?>  