<?php
    namespace Models;

    class Company{

        private $id_Company;
        private $name;
        private $yearFoundation;
        private $description;
        private $logo;
        private $email;
        private $phoneNumber;
        private $city;

       
        public function getIdCompany()
        {
                return $this->id_Company;
        }

        public function setIdCompany($id_Company)
        {
                $this->id_Company = $id_Company;
        }

        
        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;
        }
    
        public function getYearFoundation()
        {
                return $this->yearFoundation;
        }

        public function setYearFoundation($yearFoundation)
        {
                $this->yearFoundation = $yearFoundation;
        }

        
        public function getDescription()
        {
                return $this->description;
        }

        
        public function setDescription($description)
        {
                $this->description = $description;
        }

        public function getLogo()
        {
                return $this->logo;
        }

       
        public function setLogo($logo)
        {
                $this->logo = $logo;
        }

        
        public function getEmail()
        {
                return $this->email;
        }

       
        public function setEmail($email)
        {
                $this->email = $email;
        }

        
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;
        }

    
        public function getCity()
        {
                return $this->city;
        }


        public function setCity(City $city)
        {
                $this->city = $city;
        }
    }



?>