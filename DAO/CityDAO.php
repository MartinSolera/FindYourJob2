<?php 
namespace DAO;

use Models\City as City;
use DAO\Connection as Connection;
use FFI\Exception;

class CityDAO{

    private $connection;
    private $nameTable;

    public function __construct(){
        $this->connection = Connection::GetInstance();
        $this->nameTable = "City";
    }

     public function GetCitys(){

        $listCitys = [];

        $query = " SELECT * FROM " . $this->nameTable ;

        try {
            $result = $this->connection->Execute($query);

        } catch (Exception $ex) {
            throw $ex;
        }

        if(!empty($result)){

            foreach($result as $value){
                $City = new City();

                $City->setIdCity($value['id_City']);
                $City->setName($value['name']);
            
                array_push($listCitys,$City); 
            }
        }
        return $listCitys;
     }

    
     public function GetCityXid($idCity){

        $query = " SELECT * FROM " . $this->nameTable . " where id_City =( :idCity)";

        $parameters['idCity'] = $idCity;

        try {
            $result = $this->connection->Execute($query, $parameters);

        } catch (Exception $ex) {
            throw $ex;
        }

        $city = null;

        if(!empty($result)){

            foreach($result as $value){
                $city = new City();

                $city->setIdCity($value['id_City']);
                $city->setName($value['name']);
               
            }
        }
        return $city;
     }

}

?>