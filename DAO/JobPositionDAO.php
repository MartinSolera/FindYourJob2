<?php
    use DAO\Connection;
    use Models\JobPosition as JobPosition;

    class JobPositionDAO {
        private $jobPositionList = array();
        private $tableName = "jobPosition";
        private $connection;

        /* private function Add (JobPosition $jobPosition){
            $this->RetrieveData();
            
            array_push($this->jobPositionList, $jobPosition);

            $this->SaveData();
        }
 */
        private function Add(JobPosition $jobPosition) {
            try {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description);";
                
                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

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
                    $jobP->setJobPositionId($row['jobPositionId']);
                    $jobP->setCareerId($row['careerId']);
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

                $jobPosition->setJobPositionId($valuesArray['jobPositionId']);
                $jobPosition->setCareerId($valuesArray['careerId']);
                $jobPosition->setDescription($valuesArray['description']);

                array_push($this->jobPositionList, $jobPosition);
            }
        }
       
        
        
    }

?>