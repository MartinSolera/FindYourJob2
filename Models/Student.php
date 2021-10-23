<?php
    namespace Models;
    use Models\Person as Person;

    class Student extends Person
    {
        private $studentId; 
        private $dni;
        private $email;
        private $password;
        private $firstName;
        private $lastName;
        private $phoneNumber;
        private $birthDate;
        private $gender; 
        private $fileNumber;
        private $careerId;
        private $active;
        private $roleId;
        
        
        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        public function getDni(){
            return $this->dni;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function getStudentId()
        {
            return $this->studentId;
        }

        public function setStudentId($studentId)
        {
            $this->studentId = $studentId;
        }

        public function getFileNumber(){
            return $this->fileNumber;
        }

        public function setFileNumber($fileNumber){
            $this->fileNumber = $fileNumber;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getBirthDate(){
            return $this->birthDate;
        }

        public function setBirthDate($birthDate){
            $this->birthDate = $birthDate;
        }

        public function getPhoneNumber(){
            return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
        }

        public function getActive(){
            return $this->active;
        }

        public function setActive($active){
            $this->active = $active;
        }

        public function getCareerId(){
            return $this->careerId;
        }

        public function setCareerId($careerId){
            $this->careerId = $careerId;
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
    
        function getPassword()
        {
            return $this->password;
        }
    
        public function setPassword($password)
        {
            $this->password = $password;
    
            return $this;
        }

        public function getRoleId(){
            return $this->roleId;
        }

        public function setRoleId($roleId){
            $this->roleId = $roleId;
        }
    }
?>

