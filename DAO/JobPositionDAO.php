<?php
    namespace DAO;

    use DAO\Connection;
    use Models\JobPosition as JobPosition;
    use DAO\IJobPosition as IJobPosition;
    use DAO\CareerDAO as CareerDAO;
    use FFI\Exception;

    class JobPositionDAO {

        private $jobPositionList = array();
        private $tableName = "jobposition";
        private $connection;
        private $careerDAO;

        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "jobposition";
            $this->companyDAO = new CompanyDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function Add(JobPosition $jobPosition) {
            try {
                $query = "INSERT INTO ".$this->tableName." (id_JobPosition, description, idCareer) VALUES (:id_JobPosition, :description, :idCareer);";
                
                $parameters["id_JobPosition"] = $jobPosition->getId();
                $parameters["description"] = $jobPosition->getDescription();
                $parameters["idCareer"] = $jobPosition->getCareer()->getCareerId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            } 
        }

        public function GetAll() {
            try {
                $jobPositionList = array();

                $query = "SELECT * FROM" . $this->tableName;
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){
                    $jobP = new JobPosition();
                    $jobP->setId($row['id_JobPosition']);
                    $jobP->setCareer($this->careerDAO->GetCareerXid($row['idCareer']));
                    $jobP->setDescription($row['description']);

                    array_push($jobPositionList, $jobP);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function RetrieveData() {

            $this->jobPositionList = array();
            
            $apiJobPosition = curl_init(API_URL.'JobPosition');
            
            curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array(API_KEY));
            curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($apiJobPosition);
            
            $arrayToDecode = json_decode($response, true);

            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition = new JobPosition();

                $jobPosition->setId($valuesArray['id_JobPosition']);
                $jobPosition->setCareer($this->careerDAO->GetCareerXid($valuesArray['careerId']));
                $jobPosition->setDescription($valuesArray['description']);

                array_push($this->jobPositionList, $jobPosition);
            }
        }
       
        public function updateJobPosition(JobPosition $jobPosition)
        {
            $sql = "UPDATE jobposition SET description=:description;";
    
            $parameters['description'] = $jobPosition->getDescription();
    
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (Exception $exception) {
                throw $exception;
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