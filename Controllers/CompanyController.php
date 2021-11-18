<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\CityDAO as CityDAO;
use Models\Company as Company;
use Models\City as City;
use Utils\Utils as Utils;
use DAO\Connection as Connection;
use DAO\JobOfferDAO as JobOfferDAO;
use Controllers\Functions;//para mensajes de dbb
use Exception;

class CompanyController
{
    private $companyDAO;
    private $cityDao;
    private $jobOfferDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->cityDao = new CityDAO();
        $this->jobOfferDAO = new JobOfferDAO();
    }


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

    public function ShowCompany ($idCompany) {
        Utils::checkSession();

        $company = $this->companyDAO->GetCompanyXid($idCompany);
       
        require_once(VIEWS_PATH."company-show.php");
        
    }

    public function ShowListViewAdmin($message = "")
    {
        Utils::checkSession();

        $companies = $this->companyDAO->GetAll();

        require_once(VIEWS_PATH."company-management.php");
    }

    public function AddCompany($name,$year,$idcity,$description,$email,$phone,$logo)
    {
        $message = null;
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
                    $message = "Company added successfully";
                    $this->ViewAddCompany($message);
                } else {
                    $message = "Couldn't add the company, please try again later"; 
                    $this->ViewAddCompany($message);
                }
            } catch (Exception $ex) {// si encuentra un error de db
    
                if(Functions::contains_substr($ex->getMessage(), "Duplicate entry"));
                $message = "You can't add this company "; 

                //validacion name
                $nameExists=$this->companyDAO->checkIfNameAlreadyExists($name);
                if($nameExists==1){
                    $message = $message . ", the name is owned by another company";
                }
                //validacion email
                $emailExists=$this->companyDAO->checkIfEmailAlreadyExists($email);
                if($emailExists==1){
                    $message = $message . ", the email already exists";
                }
                //validacion phone number
                $phoneExists=$this->companyDAO->checkIfPhoneAlreadyExists($phone);
                if($phoneExists==1){
                    $message = $message . ", the phone number belongs to another company";
                }
                $this->ViewAddCompany($message);
            }
           
    }

    public function DeleteCompany($idCompany)
    {
        Utils::checkSession();
        $associated = $this->jobOfferDAO->checkIfCompanyIsAsociated($idCompany);

        if($associated==false) {
            $removed = $this->companyDAO->DeleteCompany($idCompany);
            if($removed==1){
                $this->ShowListViewAdmin("company deleted succesfully");
            }else{
                $this->ShowListViewAdmin("couldn't delete the company, try later");
            }
        }
        else{
            $this->ShowListViewAdmin("cannot delete the company because it's associated with a job offer");
        }
       
    }

    public function ModifyCompany($yearFoundation, $idCity, $description, $phoneNumber, $idCompany)
    {
        Utils::checkSession();

        try{

        $result = $this->companyDAO->updateCompany($yearFoundation, $idCity, $description, $phoneNumber, $idCompany);
       
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

    public function ShowListViewCompanyAsc($message = "")
    {
        Utils::checkSession();

        $companies = $this->companyDAO->GetAllAsc();
        
        require_once(VIEWS_PATH."company-management.php");
    }

    public function ShowListViewCompanyDesc($message = "")
    {
        Utils::checkSession();

        $companies = $this->companyDAO->GetAllDesc();
        
        require_once(VIEWS_PATH."company-management.php");
    }

}