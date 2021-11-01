<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;
use Utils\Utils as Utils;
use DAO\Connection as Connection;
use Controllers\Functions;//para mensajes de dbb
use PDOException;

class CareerController
{
    private $careerDAO;
    

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
    }

    /* public function UpdateCareerDB(){
        Utils::checkAdminSession();
    
        $result=$this->careerDAO->updateCareerDB();//si retorna 1 se agregaron todas las carreras con exito
        
        return $result;
    } */

   
}

?>