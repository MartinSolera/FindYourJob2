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
    
        public function getYearFoundation()
        {
                return $this->yearFoundation;
        }

        public function setYearFoundation($yearFoundation)
        {
                $this->yearFoundation = $yearFoundation;

                return $this;
        }

        
        public function getDescription()
        {
                return $this->description;
        }

        
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public function getLogo()
        {
                return $this->logo;
        }

       
        public function setLogo($logo)
        {
                $this->logo = $logo;

                return $this;
        }

        
        public function getEmail()
        {
                return $this->email;
        }

       
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

    
        public function getCity()
        {
                return $this->city;
        }


        public function setCity(City $city)
        {
                $this->city = $city;

                return $this;
        }
    }



?>