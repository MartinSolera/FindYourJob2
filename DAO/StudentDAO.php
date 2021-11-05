<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use DAO\Connection as Connection;
    use Models\Mail as Mail;
    
    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();
        private $connection;


        public function Delete($idToDelete){

            $sql = "DELETE FROM students WHERE studentId=:studentId";
            $parameters['studentId']=$idToDelete;
            try{
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            }catch(\PDOException $exeption){
                throw $exeption;
            }

        }

        public function Update($student, $toFind){
            $sql = "UPDATE students set careerId=:careerId, firstName=:firstName, lastName=:lastName, dni=:dni, fileNumber=:fileNumber, 
                     gender=:gender, birthDate=:birthDate, email=:email, phoneNumber=:phoneNumber WHERE studentId= '$toFind';";

            $parameters["firstName"]=$student->getFirstName();
            $parameters['lastName']=$student->getLastName();
            $parameters['dni']=$student->getDni();
            $parameters['gender']=$student->getGender();
            $parameters['birthDate']=$student->getBirthDate();
            $parameters['phoneNumber']=$student->getPhoneNumber();
            $parameters['active']=$student->getActive();

            try{
                $this->connection=Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            }catch(\PDOException $exeption){
                throw $exeption;
            }
                     
        }

        
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

        private function RetrieveData()
        {
            $this->studentList = array();

            $apiStudent = curl_init(API_URL.'Student');
            
            curl_setopt($apiStudent, CURLOPT_HTTPHEADER, array(API_KEY));
            curl_setopt($apiStudent, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($apiStudent);
          
            $arrayToDecode = json_decode($response, true);
           
            foreach($arrayToDecode as $valuesArray)
            {
                $student = new Student();

                $student->setStudentId($valuesArray["studentId"]);
                $student->setFirstName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);
                $student->setDni($valuesArray["dni"]);
                $student->setFileNumber($valuesArray["fileNumber"]);
                $student->setEmail($valuesArray["email"]);
                $student->setBirthDate($valuesArray["birthDate"]);
                $student->setGender($valuesArray["gender"]);
                $student->setPhoneNumber($valuesArray["phoneNumber"]);
                $student->setActive($valuesArray["active"]);

                array_push($this->studentList, $student);  
            } 
        }
 
        public function GetByStudentDni($studentDni)
        {
            $this->RetrieveData();
    
            foreach ($this->studentList as $student) {
                if ($student->GetByStudentDni() == $studentDni){
                    return $student;
                }
            }
    
            return null;
        }

        public function existsByEmail($email){
            $exists=false;
            $this->RetrieveData();

            foreach($this->studentList as $student){
                if($student->getEmail() == $email){
                    $exists = true;
                }
            }
            return $exists;
        }
        
        public function getStudentByMail($email)
        {
            $this->RetrieveData();

            foreach ($this->studentList as $student) {
                if ($student->getEmail() == $email){
                    return $student;
                }
            }
                return false;
        }

        public function GetByStudentId($studentId)
        {
            $this->RetrieveData();
    
            foreach ($this->studentList as $student) {
                if ($student->getStudentId() == $studentId){
                    return $student;
                }
            }
    
            return null;
        }

        public function generateEmail($emailInfo, $student){

            if(!empty($emailInfo)){
                $message = "El CORREO FUE ENVIADO";
                $mail = new Mail();
                $mail->sendMail($emailInfo,$student); 
                $this->HomeController->Home($message);
                
            }else{
                $message = "NOOO se pudo enviar el email";
                $this->HomeController->Home($message);
            }

           
        
        }


    }
?>