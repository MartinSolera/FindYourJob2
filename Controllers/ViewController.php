<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Utils\Utils as Utils;

    class ViewController{
        
        private $jobOfferDAO;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;
        
        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
        }

        public function showAdminMenu($message = "")
        {
            Utils::checkSession();
            require_once(VIEWS_PATH."home-admin.php");
        }
        
        public function LogOut(){

            Utils::logout();
        }

        public function showStudentMenu()
        {
            Utils::checkStudentSession();
            require_once(VIEWS_PATH."home-student.php");
        }


    }
?>