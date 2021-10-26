<?php
     namespace Controllers;

     use DAO\StudentDAO as StudentDAO;
     use Models\Student as Student;
     use Utils\Utils as Utils;
     use DAO\CareerDAO as CareerDAO;
 
     class StudentController
     {
         private $studentDAO;
 
         public function __construct()
         {
             $this->studentDAO = new StudentDAO();
         }
 
         public function ExistsByEmail($student){
             $exists = $this->studentDAO->existsByEmail($student->getEmail());
 
             return $exists;
         }

         public function LogOut(){
             Utils::logout();
         }

         public function ShowCompaniesView(){
            Utils::checkStudentSession(); 
            require_once(VIEWS_PATH."list-companies-std.php");
        }

        public function ShowStudentList($message = "")
        {
            Utils::checkAdminSession();
            $this->studenList= $this->studentDAO->GetAll();
            $this->careerList= $this->careerDAO->GetAll();
            require_once(VIEWS_PATH."list-student.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            
            if(isset($_SESSION['admin']) || ($_SESSION['student']->getStudentId() == $studentId)) {
                $student = $this->studentDAO->GetByStudentId($studentId);
                $career = $this->careerDAO->getCareerStudent($student);
    
                require_once(VIEWS_PATH."student-show.php");
            }  else {
                Utils::checkAdminSession();
            }
        }

        public function getByEmail($email){
            $student = $this->studentDAO->GetByStudentEmail($email);
            return $student;
        }

        public function JobOfferManagment($message = "")
        {
             Utils::checkAdminSession();
            require_once(VIEWS_PATH."jobOffer-managment.php");
        }



    }

?>