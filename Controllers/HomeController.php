<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Student as Student;
    use Controllers\CompanyController as CompanyController;
    use Utils\Utils as Utils;
    use DAO\StudentDAO as StudentDAO;
    class HomeController
    {
        private $studentController;
        private $companyController;
        private $studentDAO;

        public function __construct(){
            $this->studentController = new StudentController();
            $this->companyController = new CompanyController();
            $this->studentDAO = new StudentDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }   

        public function login($email, $password){
            $studentController = new StudentController();
            $student = new Student();
            $student->setEmail($email);

            if(($email == 'admin@utn.com') && ($password == "admin")){
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $_SESSION['admin'] = $user;

                require_once(VIEWS_PATH . "home-admin.php");

            }
            else if($studentController->existsByEmail($student)){
                $_SESSION['student'] = $student;

                //$this->companyController->ShowListViewStudent("Welcome!"); 
                require_once(VIEWS_PATH . "home-student.php");

            }
            else{
                $this->Index("Error: el usuario no se encuentra en el sistema.");
            }
        }

        public function RedirectHome()
        {
            Utils::checkSession();
            if (isset($_SESSION['admin'])) {
                require_once(VIEWS_PATH . "home-admin.php");
            } else {
                $student = $_SESSION['student'];
                require_once(VIEWS_PATH . "home-student.php");
            }
           
        }

        public function RegisterValidation($email)
        {
                $student = $this->studentDAO->getStudentByMail($email);
                // $career = $this->careerDAO->getCareerStudent($student);
            if ($student != null)
            {
                require_once(VIEWS_PATH . "user-registration.php");
            } else {
                $message = "This mail is incorrect. Please try again";
                require_once(VIEWS_PATH . "user-validation.php");
            }
        }

        public function ShowRegister()
        {
            require_once(VIEWS_PATH . "user-validation.php");
        }
    } 
    
    
?>