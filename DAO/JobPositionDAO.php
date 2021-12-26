<?php
    namespace DAO;

    use DAO\Connection;
    use Models\JobPosition as JobPosition;
    use DAO\IJobPosition as IJobPosition;
    use DAO\CareerDAO as CareerDAO;
    use Models\Career as Career;
    use FFI\Exception;

    class JobPositionDAO implements IJobPositionDAO{

        private $jobPositionList;
        private $tableName;
        private $connection;
        private $careerDAO;
        private $fileName;

        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "jobposition";
            $this->companyDAO = new CompanyDAO();
            $this->careerDAO = new CareerDAO();
            $this->jobPositionList = array();
            $this->fileName = ROOT ."Data/job-positions.json";
        }

        public function Add(JobPosition $jobPosition) {
        
            $query = "INSERT INTO jobposition (id_JobPosition, description, idCareer) VALUES (:id_JobPosition, :description, :idCareer);";
                
            $parameters["id_JobPosition"] = $jobPosition->getId();
            $parameters["description"] = $jobPosition->getDescription();
            $parameters["idCareer"] = $jobPosition->getCareer()->getCareerId();

            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            } 
            return $result;
        }

        public function GetAll() { //from DB
            $jobPList = [];

            $query = "SELECT * FROM jobposition;";
            
            try{
                $result = $this->connection->Execute($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            if(!empty($result)){
                foreach($result as $value){

                    $jobP = new JobPosition();

                    $jobP->setId($value['id_JobPosition']);
                    $jobP->setDescription($value['description']);
                    $jobP->setCareer($this->careerDAO->GetCareerXid($value['idCareer']));
                    
                    array_push($jobPList, $jobP);
                }
            }
            return $jobPList;
        }

        public function existsById($id){
            $exists = null;
            $jobPositions = $this->GetAll();

            foreach($jobPositions as $jobP){
                if($jobP->getId() == $id){
                    $exists = $jobP;
                }
            }
            return $exists;
        }

        private function RetrieveData() //para json
        {
            $this->jobPositionList = array();
    
            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);
    
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
    
                foreach($arrayToDecode as $value)
                {
                    $jobP = new JobPosition();

                    $jobP->setId($value['jobPositionId']);
                    $jobP->setDescription($value['description']);
                    $jobP->setCareer($this->careerDAO->GetCareerXid($value['careerId']));
                    
                    array_push($this->jobPositionList, $jobP);
                }
            }
        }

        public function updateJobPositionDB(){
            //$this->getJobPositionsFromAPI();
            $this->RetrieveData();
    
            foreach ($this->jobPositionList as $jobP) {
               
                $exists = $this->existsById($jobP->getId());
                if($exists == null) {
                    $this->Add($jobP);
                } 
                else{
                    $result = $this->updateJobP($jobP);
                }
            }
        }

        public function updateJobP(JobPosition $jobPosition) {

            $sql = "UPDATE jobposition SET description = :description , idCareer = :idCareer WHERE (id_JobPosition = :id_JobPosition);" ;
            
            $parameters['id_JobPosition'] = $jobPosition->getId();
            $parameters['description'] = $jobPosition->getDescription();
            $parameters['idCareer'] = $jobPosition->getCareer()->getCareerId();
            
            try {
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
            return $result;
        }

        private function getJobPositionsFromAPI() { 

            $this->jobPositionList = array();
            
            $apiJobPosition = curl_init(API_URL.'JobPosition');
            
            curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array(API_KEY));
            curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($apiJobPosition);
            
            $arrayToDecode = json_decode($response, true);

            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition = new JobPosition();

                $jobPosition->setId($valuesArray['jobPositionId']);
                $jobPosition->setCareer($this->careerDAO->GetCareerXid($valuesArray['careerId']));
                $jobPosition->setDescription($valuesArray['description']);

                array_push($this->jobPositionList, $jobPosition);
            }
        }
        
        public function deleteJobPosition($jobPosition)
        {
            $sql = "DELETE FROM jobposition WHERE id_JobPosition=:id_JobPosition";
            $parameters['id_JobPosition'] = $jobPosition;
    
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        }

        public function GetJobPositionXid($idJobP){

            $query = " SELECT * FROM jobposition WHERE id_JobPosition = (:id_JobPosition)";
    
            $parameters['id_JobPosition'] = $idJobP;
    
            try {
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            $jobP = null;
    
            if(!empty($result)){
    
                foreach($result as $value){

                    $jobP = new JobPosition();

                    $jobP->setId($value['id_JobPosition']);
                    $jobP->setCareer($this->careerDAO->GetCareerXid($value['idCareer']));
                    $jobP->setDescription($value['description']);
                }
            }
            return $jobP;
         }

        
    }

?>