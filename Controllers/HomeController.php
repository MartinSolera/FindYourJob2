<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Student as Student;
    use Controllers\CompanyController as CompanyController;
    use Controllers\UserController as UserController;
    use Utils\Utils as Utils;
    use DAO\StudentDAO as StudentDAO;
    use DAO\UserDAO as UserDao;
    use Controllers\ViewController as ViewController;

    class HomeController
    {
        private $studentController;
        private $companyController;
        private $studentDAO;
        private $userDao;
        private $user;
        private $viewController;

        public function __construct(){
            $this->studentController = new StudentController();
            $this->companyController = new CompanyController();
            $this->UserController = new UserController();
            $this->userDao = new UserDao();
            $this->studentDAO = new StudentDAO();
            $this->viewController = new ViewController();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."presentation.php");
        }   

        public function searchApiStudent($studentEmail,$user){

            $studentEmail = ($user->getEmail());
            $studentList = $this->StudentDAO->GetAll();
                    
             $active = false;

                foreach($studentList as $student){
                    if($student->getEmail() == $studentEmail){
                          $active = true;
                         break;
                     }
                 }
                return $active;
        }

        public function login ($email, $password){

            $message = null;

            $userController = new UserController();
            $user = new User();

            $user = $this->userDao->getUserByLog($email,$password);

            if(!empty($user)){
                
                /// 1 = ADMIN
                if($user->getUserType()->getId() == 1){
                    $_SESSION['admin'] = $user;
                    require_once(VIEWS_PATH . "home-admin.php");
                }
                /// 2 = Student
                elseif ($user->getUserType()->getId() == 2) {
                    $status = $this->studentDAO->getStudentByMail($email);

                    if($status != null && $status->getActive() == true){ ///Preguntar de que pegue contra la api
                        $_SESSION['student'] = $user;
                        require_once(VIEWS_PATH . "home-student.php");
                    }else{
                        $message = "This student is not available";
                        $this->Index($message);
                    }
                }elseif ($user->getUserType()->getId()==3)
                {
                    $_SESSION['company'] = $user;
                    require_once(VIEWS_PATH . "addJobOfferByCompany.php");

                }
            }
            else{
                $message = "Error, email or password are wrong";
                $this->viewController->Home($message);
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
            require_once(VIEWS_PATH . "user-validation.php");
        }

        public function CompanyShowRegister()
        {
            require_once(VIEWS_PATH . "company-validation.php");
        }

        public function checkPassword($Password)
        {
            $message = null;

            if ($Password == "admin" )
            {
                require_once(VIEWS_PATH . "company-registration.php");

            }else
            {
                $message = "Incorrect password.";
                $this->companyValidationView($message);
            }

        }

        public function checkCompanyResgiter ($email)
        {
            $message = null;

            $statusUser = $this->userDao->getUserFromDB($email);

            if ($statusUser != null){
                ///El usuario ya existe en el sistema.

                $message = "This email is already in use ";
                 $this->userValidationView($message);

        }else{

        }
            $checkStudent = $this->studentDAO->getStudentByMail($email);
            if($checkStudent == false){
            
                $company= $checkStudent;
                require_once(VIEWS_PATH . "company-registration.php");
            }else
            {
                $message= "the email entered belongs to a student";
                $this->userValidationView($message);
            }


        }

        public function checkRegister($email){

            $message = null;

            $statusUser = $this->userDao->getUserFromDB($email);

            if ($statusUser != null){
                ///El usuario ya existe en el sistema.

                $message = "This email is already in use ";
                 $this->userValidationView($message);

        } else {
    
            //$allStudents = $this->studentDAO->GetAll();
            $checkStudent = $this->studentDAO->getStudentByMail($email);

            if($checkStudent == false){
                $message = "Your email is not registered in campus <br> you can't register "; 
                $this->userValidationView($message);
            }
            else if($checkStudent->getActive() == false){
                $message = "Your email is not active in the campus <br> try contacting the university administration"; 
                $this->userValidationView($message);
            }
            else{
                $student= $checkStudent;
                require_once(VIEWS_PATH . "user-registration.php");

            }
        }
    }

    public function userValidationView($message = "")
        {
            require_once(VIEWS_PATH."user-validation.php");
        }
        
        public function CompanyValidationView($message = "")
        {
            require_once(VIEWS_PATH."company-validation.php");
        }   

}
?>