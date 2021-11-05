<?php

namespace Controllers;

use Controllers\StudentController as StudentController;
use Models\Student as Student;
use Models\User as User;
use DAO\UserDAO as UserDAO;
use DAO\StudentDAO as StudentDAO;
use Models\UserType as UserType;

class UserController{

    private $UserDAO;

    public function __construct()

        {
            $this->UserDAO = new UserDAO();
            $this->StudentDAO = new StudentDAO();
        }

        public function userRegister($email, $password, $confirmPass, $personalEmail){
        $message = null;

        if ($password == $confirmPass)
        {
            $studentController = new StudentController();
            $student = new Student();
            $student = $studentController->getByEmail($email);
    
            if ($student != null) {
                
                if($this->UserDAO->getUserByEmail($email) == null){
                    $newUser = new User();
                    $newUserType = new UserType();
                    $newUserType->setId(2);

                    $newUser->setEmail($email);
                    $newUser->setPassword($password);
                    $newUser->setId($student->getStudentId());
                    $newUser->setUserType($newUserType);
            
                    $this->UserDAO->Add($newUser);
                    
                    require_once(VIEWS_PATH . "login.php");
                } else {
                    
                    require_once(VIEWS_PATH . "login.php");
                }
                
            } else {
                //$invalidEmail = true;
                $message = "There aren't student with this email in the system";
                $this->userValidationView($message);
            }

        }
        else{
            $message = "The passwords do not match";
            $this->userValidationView($message);
        }



        if(!empty($personalEmail)){
            $this->StudentDAO->generateEmail($personalEmail, $student);
        }
        else{
            echo "No quizo meter un mail personal ...";
        }

    }







    public function getUserByEmail($email){
        $user = $this->UserDAO->getUserByEmail($email);
        return $user;
    }

    public function userValidationView($message = "")
        {
            require_once(VIEWS_PATH."user-validation.php");
        }   

}