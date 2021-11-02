<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;
    use DAO\JobPositionDAO as JobPositionDAO;
    use FFI\Exception;

    class JobOfferDAO {

        private $connection;
        private $nameTable;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;

        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "joboffer";
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
        }

        public function Add(JobOffer $jobOffer) {
            $query = "INSERT INTO joboffer (description, dateTime, limit_date, timeState, userState, idUser, idJobPosition, idCompany) value (:description, :dateTime, :limit_date, :timeState, :userState, :idUser, :idJobPosition, :idCompany);";
            
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limit_date'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
            $parameters['userState'] = $jobOffer->getUserState();
            $parameters['idUser'] = $jobOffer->getUser();
            $parameters['idJobPosition'] = $jobOffer->getJobPosition()->getId();
            $parameters['idCompany'] = $jobOffer->getCompany()->getIdCompany();
            echo 'id job position:'. $jobOffer->getJobPosition()->getId();
            echo 'id job company:'. $jobOffer->getCompany()->getIdCompany();
            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
                echo $result;
            } catch (Exception $ex) {
                throw $ex;
            }
            return $result;
        }


        public function GetAll() {

            $listJobOffers = [];
    
            $query = " SELECT * FROM " . $this->nameTable ;
    
            try {
                $result = $this->connection->Execute($query);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            if(!empty($result)) {
    
                foreach($result as $value){

                    $jobOffer = new JobOffer();
                    
                    $jobOffer->setIdJobOffer($value['id_JobOffer']);
                    $jobOffer->setDescription($value['description']);
                    $jobOffer->setDateTime($value['datetime']);
                    $jobOffer->setLimitDate($value['limit_date']);
                    $jobOffer->setTimeState($value['timeState']);
                    $jobOffer->setUserState($value['userState']);
                    $jobOffer->setUser($this->userDAO->GetUserXid($value['idUser']));
                    $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                    $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
                    
                    array_push($listJobOffers, $jobOffer);
                }
            }
            return  $listJobOffers;
        }
        
        public function DeleteJobOffer($id_jobOffer)
        {
            $sql = "DELETE FROM joboffer WHERE id_JobOffer = :id_JobOffer";
            $parameters['id_JobOffer'] = $id_jobOffer;
     
            try {
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
    
            }  catch (Exception $exception) {
                throw $exception;
            }
        }
     

        public function updateJobOffer(JobOffer $jobOffer)
        {
            $query = "UPDATE joboffer SET name=:name, description, dateTime, limit_date, timeState, userState, idUser, idJobPosition, idCompany WHERE  id_JobOffer = :id_JobOffer" ;
            

            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limit_date'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
            $parameters['userState'] = $jobOffer->getUserState();
            $parameters['idUser'] = $jobOffer->getUser()->getId();
            $parameters['idJobPosition'] = $jobOffer->getJobPosition()->getId();
            $parameters['idCompany'] = $jobOffer->getCompany()->getIdCompany();
            
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        }

        public function searchJobOffer($id_jobOffer)
        {
            $sql = "SELECT * FROM joboffer WHERE id_JobOffer=:id_JobOffer";
            $parameters['id_JobOffer'] = $id_jobOffer;
    
            try {
                $this->connection = Connection::getInstance();
                $this->jobOfferList = $this->connection->execute($sql, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
           
            if (!empty($jobOfferList)) {
                return $this->retrieveDataJobOffer();
            } else {
                return false;
            }
        }

        private function retrieveDataJobOffer()
        {
            $listToReturn = array();
    
            foreach ($this->jobOfferList as $value) {
                $jobOffer = new JobOffer();
                $jobOffer->setDescription($value['description']);
                $jobOffer->setDateTime($value['datetime']);
                $jobOffer->setLimitDate($value['limit_date']);
                $jobOffer->setTimeState($value['timeState']);
                $jobOffer->setUserState($value['idUser']);

                $jobOffer->setUser($this->userDao->GetUserXid($value['idUser']));
                $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
    
                array_push($listToReturn, $jobOffer);
            }
            return  $listToReturn;
        }


    }

?>