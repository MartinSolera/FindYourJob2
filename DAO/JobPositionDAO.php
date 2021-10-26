<?php
    use DAO\Connection;
    use Models\JobPosition as JobPosition;

    class JobPositionDAO {
        
        private $jobPositionList = array();
        private $tableName = "jobposition";
        private $connection;

        /* private function Add (JobPosition $jobPosition){
            $this->RetrieveData();
            
            array_push($this->jobPositionList, $jobPosition);

            $this->SaveData();
        }
 */
        private function Add(JobPosition $jobPosition) {
            try {
                $query = "INSERT INTO ".$this->tableName." (id_JobPosition, description, idCareer) VALUES (:id_JobPosition, :description, :idCareer);";
                
                $parameters["id_JobPosition"] = $jobPosition->getId();
                $parameters["description"] = $jobPosition->getDescription();
                $parameters["idCareer"] = $jobPosition->getCareerId();

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
                    $jobP->setCareerId($row['idCareer']);
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
                $jobPosition->setCareerId($valuesArray['careerId']);
                $jobPosition->setDescription($valuesArray['description']);

                array_push($this->jobPositionList, $jobPosition);
            }
        }
       

        
        
    }

?>