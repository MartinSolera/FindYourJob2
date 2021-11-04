<?php

namespace Controllers;

use Controllers\StudentController as StudentController;
use Models\Student as Student;
use Models\User as User;
use DAO\UserDAO as UserDAO;

class UserController{

    private $UserDAO;

    public function __construct()

        {
            $this->UserDAO = new UserDAO();
        }

        public function userRegister($email, $password, $confirmPass){
        $message = null;

        if ($password == $confirmPass)
        {
            $studentController = new StudentController();
            $student = new Student();
            $student = $studentController->getByEmail($email);
    
            if ($student != null) {
                
                if($this->UserDAO->getUserByEmail($email) == null){
                    $newUser = new User();
                    $newUser->setEmail($email);
                    $newUser->setPassword($password);
                    $newUser->setId($student->getStudentId());
                    $newUser->setUserType(2);
            
                    $this->UserDAO->Add($newUser);
    
                    $succesfulRegistration = true;
                    require_once(VIEWS_PATH . "login.php");
                } else {
                    $registedEmail = true;
                    require_once(VIEWS_PATH . "login.php");
                }
                
            } else {
                $invalidEmail = true;
                $message = "Error al ingresar";
                $this->userRegisterView($message);
                //require_once(VIEWS_PATH . "login.php");
            }

        }
        else{
            $message = "No coinciden las password";
            $this->userRegisterView($message);
            require_once(VIEWS_PATH . "login.php");
        }

    }

    public function getUserByEmail($email){
        $user = $this->UserDAO->getUserByEmail($email);
        return $user;
    }

    public function userRegisterView($message = "")
        {
            require_once(VIEWS_PATH."user-validation.php");
        }   

}