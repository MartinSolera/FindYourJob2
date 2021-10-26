<?php
    namespace DAO;

    use Models\Company as Company;
    use DAO\ICompanyDAO as ICompanyDAO;
    use DAO\Connection as Connection;
    use DAO\CityDAO as CityDAO;
    use FFI\Exception;//agregar para errores de try 


    class CompanyDAO implements ICompanyDAO{

       // private $companyList = array();
        private $connection;
        private $tabletName;
        private $cityDao;


        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "Company";
            $this->cityDao = new CityDAO();
        }

        public function Add(Company $company){

            $query = " INSERT INTO ". $this->nameTable . " (name , yearFoundation , description , logo , email , phoneNumber ,idCity ) value ( :name , :yearFoundation , :description , :logo , :email , :phoneNumber , :idCity)";
    
            $parameters['name'] = $company->getName();
            $parameters['yearFoundation'] = $company->getyearFoundation();
            $parameters['description'] = $company->getdescription();
            $parameters['logo'] = $company->getlogo();
            $parameters['email'] = $company->getemail();
            $parameters['phoneNumber'] = $company->getphoneNumber();
            $parameters['idCity'] = $company->getCity()->getIdCity();
            
            try {
                $result = $this->connection->ExecuteNonQuery($query,$parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
          
            return $result;
         }


         public function GetAll(){

            $listCompany = [];
    
            $query = " SELECT * FROM " . $this->nameTable ;
    
            try {
                $result = $this->connection->Execute($query);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            if(!empty($result)){
    
                foreach($result as $value){

                    $company = new Company();

                $company->setIdCompany($value['id_Company']);
                $company->setName($value["name"]);
                $company->setYearFoundation($value["yearFoundation"]);
                $company->setDescription($value["description"]);
                $company->setLogo($value["logo"]);
                $company->setEmail($value["email"]);
                $company->setPhoneNumber($value["phoneNumber"]);
                $company->setCity($this->cityDao->GetCityXid($value['idCity']));
                

                array_push($listCompany, $company);
            }
        }
            return  $listCompany;
         }
        

         public function DeleteCompany($email)
         {
             $sql = "DELETE FROM company WHERE email = :email";
             $parameters['email'] = $email;
     
             try {
                $this->connection = Connection::getInstance();
                $result = $this->connection->ExecuteNonQuery($sql,$parameters);
    
            }  catch (\PDOException $exception) {
                throw $exception;
            }
         }

         public function UpdateCompany($name, $year_foundation, $city, $description, $email, $phone_number, $logo)
         {
 
             try{
 
             $sql = "UPDATE company SET name=:name, year_foundation=:year_foundation, city=:city, description=:description, logo=:logo, email=:email, phone_number=:phone_number WHERE companyId = :companyId;";
     
             //$parameters['companyId'] = $company->getCompanyId();
             $parameters['name'] = $name;
             $parameters['year_foundation'] = $year_foundation;
             $parameters['city'] = $city;
             $parameters['description'] = $description;
             $parameters['logo'] = $logo;
             $parameters['email'] = $email;
             $parameters['phone_number'] = $phone_number;
             
            // $this->connection = Connection::getInstance();
             return $this->connection->ExecuteNonQuery($sql, $parameters);
 
             }   catch (\PDOException $exception) {
                 throw $exception;
             }
         }
 
         public function Search($companyId)
         {
             $sql = "SELECT * FROM companies WHERE companyId=:companyId";
             $parameters['companyId'] = $companyId;
     
             try {
                // $this->connection = Connection::getInstance(); ya esta en el constructor
                 $companiesList = $this->connection->execute($sql, $parameters);
             } catch (\PDOException $exception) {
                 throw $exception;
             }
             if (!empty($companiesList)) {
                 return $this->retrieveData();
             } else {
                 return false;
             }
         }


       /* public function Add(Company $company)
        {
            try {

            $sql = "INSERT INTO company(name, year_foundation, city, description, logo, email, phone_number) 
                    VALUES(:name, :year_foundation, :city, :description, :logo, :email, :phone_number);";
    
            $parameters['name'] = $company->getName();
            $parameters['year_foundation'] = $company->getYearFoundation();
            $parameters['city'] = $company->getCity();
            $parameters['description'] = $company->getDescription();
            $parameters['logo']=$company->getLogo();
            $parameters['email'] = $company->getEmail();
            $parameters['phone_number'] = $company->getPhoneNumber();
    
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (\PDOException $exeption) {
                throw $exeption;
            }
        }

        public function GetAll()
        {
    
            $sql = "SELECT * FROM ".$this->tabletName;
    
            try {
                $this->connection = Connection::getInstance();
                $this->companiesList = $this->connection->execute($sql);
               
            } catch (\PDOException $exeption) {
                throw $exeption;
            }
    
            if (!empty($this->companiesList)) {
                return $this->retrieveData();
            } else {
                return false;
            }
        }
        
        private function RetrieveData(){

            $listCompanies = array ();
            
            foreach($this->companiesList as $valuesArray){

                $company = new Company();
                //Agregar id
                $company->setName($valuesArray["name"]);
                $company->setYearFoundation($valuesArray["year_foundation"]);
                $company->setCity($valuesArray["city"]);
                $company->setDescription($valuesArray["description"]);
                $company->setLogo($valuesArray["logo"]);
                $company->setEmail($valuesArray["email"]);
                $company->setPhoneNumber($valuesArray["phone_number"]);
                
                array_push($listCompanies, $company);
            }

            return $listCompanies;
        }*/
        
        
       


        /*public function ModifyCompany($name, $year, $city, $description, $email, $phone, $logo,$nameCompany , $emailCompany){
            $this->RetrieveData();
            $newList = array();
            foreach ($this->companyList as $company){
                if(($company->getName() != $nameCompany) && ($company->getEmail() != $emailCompany) ){
                    array_push($newList,$company);
    
               }else{
                $company->setName($name);
                $company->setYearFoundation($year);
                $company->setCity($city);
                $company->setDescription($description);
                $company->setEmail($email);
                $company->setPhoneNumber($phone);
                $company->setLogo($logo);

                array_push($newList,$company);
                    }
    
              } 
              $this->companyList = $newList;
             $this->SaveData(); 
    
           }
        

        public function GetCompany($companyName, $email)
        {
            $this->RetrieveData();
            $comp = null;

            foreach($this->companyList as $company) {
                if($company->getName() == $companyName && $company->getEmail() == $email) {
                    $comp = $company;
                }
            }
            return $comp;
        }*/

     

       

    }

?>