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
    
        $result=$this->careerDAO->updateCareerDB();//si retorna 1 se agregaron todas las carreras con exito
        
        return $result;
    }

   
}

?>