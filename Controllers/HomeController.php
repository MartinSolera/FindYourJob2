<?php
    namespace Controllers;

    use Models\User as User;
    use Models\Student as Student;
    use Controllers\CompanyController as CompanyController;
    use Controllers\UserController as UserController;
    use Utils\Utils as Utils;
    use DAO\StudentDAO as StudentDAO;
    use DAO\UserDAO as UserDao;


    class HomeController
    {
        private $studentController;
        private $companyController;
        private $studentDAO;
        private $userDao;
        private $user;

        public function __construct(){
            $this->studentController = new StudentController();
            $this->companyController = new CompanyController();
            $this->UserController = new UserController();
            $this->userDao = new UserDao();
            $this->studentDAO = new StudentDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
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

                    $status = $this->searchApiStudent($user->getEmail(),$user);

                    if($status == true){
                        $_SESSION['student'] = $user;
                        require_once(VIEWS_PATH . "home-student.php");
                    }else{
                        $message = "This Student is not available";
                        $this->Index($message);
                    }
                }
            }
            else{
                $message = "Error, email or password are wrong";
                $this->Index($message);
            }  
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

        public function checkRegister($email){
            $statusUser = $this->userDao->getUserFromDB($email);

            if ($statusUser != null){
                ///El usuario ya existe en el sistema.
                ///Tengo que mostrar un cartel que diga "el usuario ya se encuentra en el sistema"

            require_once(VIEWS_PATH . "user-registration.php");
        } else {

            ///El usuario no se encuentra en el sistema
            

            $message = "This mail is incorrect. Please try again";
            require_once(VIEWS_PATH . "user-validation.php");
        }
    }
}
?>