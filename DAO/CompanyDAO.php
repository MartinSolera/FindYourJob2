<?php
    namespace DAO;

    use Models\Company as Company;
    use DAO\ICompanyDAO as ICompanyDAO;
    use DAO\Connection as Connection;
    use DAO\CityDAO as CityDAO;
    use FFI\Exception;//agregar para errores de try 


    class CompanyDAO implements ICompanyDAO{

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
        

         public function DeleteCompany($idCompany)
         {
             $sql = "DELETE FROM company WHERE id_Company = :id_Company";

             $parameters['id_Company'] = $idCompany;
     
             try {
        
                $result = $this->connection->ExecuteNonQuery($sql,$parameters);
    
            }  catch (\PDOException $exception) {
                throw $exception;
            }

         }

         public function GetCompanyXid($idCompany){

            $query = " SELECT * FROM " . $this->nameTable . " WHERE id_Company = (:idCompany)"; //company WHERE id_Company = :idCompany";
    
            $parameters['idCompany'] = $idCompany;
    
            try {
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            $company = null;
    
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
                   
                }
            }
            return $company;
         }

         public function UpdateCompany($name, $yearFoundation, $idCity, $description, $email, $phoneNumber, $logo,$idCompany) {

           
            $query = "UPDATE " . $this->nameTable . " SET name = :name, yearFoundation = :yearFoundation , description = :description, logo = :logo, email = :email, phoneNumber = :phoneNumber , idCity = :idCity  WHERE (id_Company = :id_Company)";
            
      
            $parameters['name'] = $name;
             $parameters['yearFoundation'] = $yearFoundation;
             $parameters['description'] = $description;
             $parameters['logo'] = $logo;
             $parameters['email'] = $email;
             $parameters['phoneNumber'] = $phoneNumber;
             $parameters['idCity'] = $idCity;
             $parameters['id_Company'] = $idCompany;
    
            try {
                
                return $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
    
        }
 
         public function Search($companyId)
         {
             $sql = "SELECT * FROM companies WHERE companyId=:companyId";
             $parameters['companyId'] = $companyId;
     
             try {
              
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

    }

?>