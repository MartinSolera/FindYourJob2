<?php
    namespace Models;

    class City{

        private $id_City;
        private $name;
       
        
        public function getIdCity()
        {
                return $this->id_City;
        }

        public function setIdCity($id_City)
        {
                $this->id_City = $id_City;

                return $this;
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }
    }



?>