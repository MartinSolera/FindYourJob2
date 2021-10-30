<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;
use Utils\Utils as Utils;
use DAO\Connection as Connection;
use Controllers\UpdateController as UpdateController;
use Controllers\Functions;//para mensajes de dbb
use PDOException;

class CareerController
{
    private $careerDAO;
    private $updateController;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
        $this->updateController = new UpdateController();
    }

    public function UpdateCareerDB(){
        Utils::checkAdminSession();
        $message=null;
        $result=$this->careerDAO->updateCareersDB();
        if($result==1){
            $message = ""
        }
        $this->companyController->ShowAdminMenu();
    }
    public function ShowAdminMenu($message = "")
    {
        Utils::checkAdminSession();

        require_once(VIEWS_PATH."home-admin.php");
    }
}

?>