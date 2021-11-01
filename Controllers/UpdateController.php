<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;
use Utils\Utils as Utils;
use DAO\Connection as Connection;
use Controllers\JobPositionController as JobPositionController;
use Controllers\CareerController as CareerController;
use Controllers\CompanyController as CompanyController;
use Controllers\Functions;//para mensajes de dbb
use PDOException;

class UpdateController
{
    private $jobPositionController;
    private $careerDAO;
    private $companyContoller;

    public function __construct()
    {
        //$this->jobPositionController = new JobPositionController();
        $this->companyContoller = new CompanyController();
        $this->careerDAO = new CareerDAO();
    }

    public function UpdateDB(){
        Utils::checkAdminSession();
        $message=null;
        $resC = $this->UpdateCareerDB();

        if($resC == 1){
            $mensaje="";
            $this->AdminMenuView($mensaje);
        } else {
            $mensaje="failed to update data";
            $this->AdminMenuView($mensaje);
        }
    }

    public function UpdateCareerDB(){
        Utils::checkAdminSession();
    
        $result=$this->careerDAO->updateCareerDB();//si retorna 1 se agregaron todas las carreras con exito
        
        return $result;
    }

    public function AdminMenuView($message = "")
    {
        Utils::checkAdminSession();

        require_once(VIEWS_PATH."home-admin.php");
    }
}

?>