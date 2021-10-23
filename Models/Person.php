<?php
    namespace Models;

    class Person
    {
        private $email; 
        private $password;
        private $isAdmin;
    
        public function getEmail()
        {
            return $this->email;
        }
    
        public function setEmail($email)
        {
            $this->email = $email;
    
            return $this;
        }
    
        function getPassword()
        {
            return $this->password;
        }
    
        public function setPassword($password)
        {
            $this->password = $password;
    
            return $this;
        }
    
        public function getIsAdmin()
        {
            return $this->isAdmin;
        }
    
        public function setIsAdmin($isAdmin){
    
            $this->isAdmin = $isAdmin;
        }
       
    }
?>