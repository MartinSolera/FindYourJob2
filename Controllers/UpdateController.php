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
    private $careerController;
    private $companyContoller;

    public function __construct()
    {
        //$this->jobPositionController = new JobPositionController();
        $this->companyContoller = new CompanyController();
        $this->careerController = new CareerController();
    }

    public function UpdateDB(){
        Utils::checkAdminSession();
        $message=null;
        $resC = $this->careerController->UpdateCareerDB();

        if($resC == 1){
            $mensaje="";
            $this->companyContoller->ShowAdminMenu($mensaje);
        } else {
            $mensaje="failed to update data";
            $this->companyContoller->ShowAdminMenu($mensaje);
        }
    }

}

?>