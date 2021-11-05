<?php
     namespace Controllers;

     use DAO\StudentDAO as StudentDAO;
     use Models\Student as Student;
     use Utils\Utils as Utils;
     use DAO\CareerDAO as CareerDAO;
 
     class StudentController
     {
         private $studentDAO;
         private $studenList = array();
 
         public function __construct()
         {
             $this->studentDAO = new StudentDAO();
             $this->careerDAO = new CareerDAO();
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
            Utils::checkSession();
            $this->studentList = $this->studentDAO->GetAll();
            require_once(VIEWS_PATH."list-student.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            
            if(isset($_SESSION['admin']) || ($_SESSION['student']->getStudentId() == $studentId)) {
                $student = $this->studentDAO->GetByStudentId($studentId);
                require_once(VIEWS_PATH."student-show.php");
            }  else {
                Utils::checkAdminSession();
            }
        }

        public function getByEmail($email){
            $student = $this->studentDAO->getStudentByMail($email);
            return $student;
        }

        public function JobOfferManagment($message = "")
        {
             Utils::checkAdminSession();
            require_once(VIEWS_PATH."jobOffer-managment.php");
        }


        public function ShowStudentMenu()
    {
        Utils::checkStudentSession();

        require_once(VIEWS_PATH."home-student.php");
    }

    }

?>