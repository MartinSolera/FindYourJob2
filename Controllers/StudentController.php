<?php
     namespace Controllers;

     use DAO\StudentDAO as StudentDAO;
     use Models\Student as Student;
     use Utils\Utils as Utils;
 
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
            require_once(VIEWS_PATH."list-student.php");
        }

        public function JobOfferManagment($message = "")
        {
             Utils::checkAdminSession();
            require_once(VIEWS_PATH."jobOffer-managment.php");
        }



    }

?>