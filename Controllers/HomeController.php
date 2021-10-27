<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Student as Student;
    use Controllers\CompanyController as CompanyController;
    use Utils\Utils as Utils;
    
    class HomeController
    {
        private $studentController;
        private $companyController;

        public function __construct(){
            $this->studentController = new StudentController();
            $this->companyController = new CompanyController();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }   

        public function login($email){
            $studentController = new StudentController();
            $student = new Student();
            $student->setEmail($email);

            if($email == 'admin@utn.com'){
                $user = new User();
                $user->setEmail($email);
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

        public function ShowRegister()
        {
            require_once(VIEWS_PATH . "user-registration.php");
        }
    } 
    
    
?>