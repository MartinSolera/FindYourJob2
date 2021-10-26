<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use Models\JobPosition as JobPosition;
    use DAO\Connection as Connection;
    use DAO\JobPositionDAO as JobPositionDAO;

    class JobOfferDAO {

        private $connection;
        private $nameTable;
        private $jobPositionDao;

        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "joboffer";
            $this->jobPositionDao = new JobPositionDAO();
        }

        public function Add(JobOffer $jobOffer){
            $query = "INSERT INTO" . $this->nameTable . " (description, dateTime, limit_date, timeState, userState, idUser, idJobPosition, idCompany) value (:description, :dateTime, :limit_date, :timeState, :userState, :idUser, :idJobPosition, :idCompany)";
            
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limit_date'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
            $parameters['userState'] = $jobOffer->getUserState();
            $parameters['idUser'] = $jobOffer->getUser()->getId();
            $parameters['idJobPosition'] = $jobOffer->getJobPosition()->getId();
            $parameters['idCompany'] = $jobOffer->getCompany()->getIdCompany();
            
            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
    
            } catch (\PDOException $ex) {
                throw $ex;
            }
            return $result;
         }


        public function GetAll() {

            $listJobOffers = [];
    
            $query = " SELECT * FROM " . $this->nameTable ;
    
            try {
                $result = $this->connection->Execute($query);
    
            } catch (\PDOException $ex) {
                throw $ex;
            }
    
            if(!empty($result)) {
    
                foreach($result as $value){

                    $jobOffer = new JobOffer();
                    
                    $jobOffer->setDescription($value['description']);
                    $jobOffer->setDateTime($value['datetime']);
                    $jobOffer->setLimitDate($value['limit_date']);
                    $jobOffer->setTimeState($value['timeState']);
                    $jobOffer->setUserState($value['idUser']);

                    $jobOffer->setUser($this->GetUserXid($value['idUser']));
                    $jobOffer->setCompany($this->GetCompanyXid($value['idCompany']));
                    $jobOffer->setJobPosition($this->GetJobPositionXid($value['idJobPosition']));
                    
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
                $this->connection = Connection::getInstance();
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
    
            }  catch (\PDOException $exception) {
                throw $exception;
            }
        }



    }

?>