<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\CityDAO as CityDAO;
use Models\Company as Company;
use Models\City as City;
use Utils\Utils as Utils;
use DAO\Connection as Connection;
use Controllers\Functions;//para mensajes de dbb
use Exception;

class CompanyController
{
    private $companyDAO;
    private $cityDao;
    private $message;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->cityDao = new CityDAO();
        $message = null;
    }


    /// REVISAR !!!
    public function ShowListViewStudent($message = "")
    {
        Utils::checkSession();

        $companies = $this->companyDAO->GetAll();

        require_once(VIEWS_PATH."list-companies-std.php");
    }

   public function ViewAddCompany($message = ""){

        Utils::checkSession();

        $listCity = $this->cityDao->GetCitys();
       
        require_once(VIEWS_PATH."addCompany.php");
    }

    public function ShowModifyCompany($idCompany)
    {

        Utils::checkSession();
        
       $company = $this->companyDAO->GetCompanyXid($idCompany);

       $listCity = $this->cityDao->GetCitys();

        require_once(VIEWS_PATH."modifyCompany.php");
    }

    public function ShowCompany ($idCompany)
    {

        $company = $this->companyDAO->GetCompanyXid($idCompany);
       
        if (isset($adminLoggedIn)) 
        {
            require_once(VIEWS_PATH."admin-company-show.php");
        }else
        {
            require_once(VIEWS_PATH."student-company-show.php");
        }
    }

    public function ShowListViewAdmin($message = "")
    {
        Utils::checkSession();

        $companies = $this->companyDAO->GetAll();

        require_once(VIEWS_PATH."company-management.php");
    }

    public function AddCompany($name,$year,$idcity,$description,$email,$phone,$logo)
    {
        Utils::checkSession();

        $city = $this->cityDao->GetCityXid($idcity);

        $newCompany = new Company();
            $newCompany->setName($name);
            $newCompany->setYearFoundation($year);
            $newCompany->setCity($city);
            $newCompany->setDescription($description);
            $newCompany->setEmail($email);
            $newCompany->setPhoneNumber($phone);
            $newCompany->setLogo($logo);

            try {
             $result = $this->companyDAO->Add($newCompany);

             if($result == 1){
             $message = "Company added";
             $this->ViewAddCompany($message);
            }
             else
             $this->ViewAddCompany("ERROR: Failed in Company Add, reintente");

            } catch (Exception $ex) {// si encuentra un error de dbb
    
                if(Functions::contains_substr($ex->getMessage(), "Duplicate entry"))
                $this->ViewAddCompany($ex->getMessage());// devuelve este mensage 

            }
           
    }

    public function DeleteCompany($email)
    {
        Utils::checkSession();

        $removed = $this->companyDAO->DeleteCompany($email);
        $this->ShowListViewAdmin("Company deleted");
    }

    public function ModifyCompany($name, $yearFoundation, $idCity, $description, $email, $phoneNumber, $idCompany)
    {
        Utils::checkSession();

        try{

        $result = $this->companyDAO->updateCompany($name, $yearFoundation, $idCity, $description, $email, $phoneNumber,$idCompany);
       
        if($result == 1)
        $this->ShowListViewAdmin("Company modified");
        else
        $this->ShowListViewAdmin("ERROR: Failed in Company modify");

        }catch(Exception $ex){

            if(Functions::contains_substr($ex->getMessage(), "Duplicate entry")) 
            $this->ShowListViewAdmin("Datos repetidos ");

            
        }

    }


    public function FilterCompanies($search)
    {
        $search = strtolower($search);
        $filteredCompanies = array();
        foreach ($this->companyDAO->getAll() as $company) 
        {
            $companyName = strtolower($company->getName());

            if (Utils::completeSearch($companyName, $search)) 
            {
                array_push($filteredCompanies, $company);
            }            
        }
        $companies = $filteredCompanies;
        if($companies == null){
            $this->ShowListViewStudent ("The company you search dosen't exist");
        }
        require_once(VIEWS_PATH . "list-companies-std.php");
    }

}