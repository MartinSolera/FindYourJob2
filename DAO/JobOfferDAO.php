<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\Connection as Connection;
    use DAO\JobPositionDAO as JobPositionDAO;
    use FFI\Exception;

    class JobOfferDAO implements IJobOfferDAO {

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
            $query = "INSERT INTO joboffer (description, dateTime, limitDate, timeState, userState, idUser, idJobPosition, idCompany) value (:description, :dateTime, :limitDate, :timeState, :userState, :idUser, :idJobPosition, :idCompany);";
            
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limitDate'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
            $parameters['userState'] = $jobOffer->getUserState();
            $parameters['idUser'] = $jobOffer->getUser()->getId();
            $parameters['idJobPosition'] = $jobOffer->getJobPosition()->getId();
            $parameters['idCompany'] = $jobOffer->getCompany()->getIdCompany();
        
            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
    
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
                    $jobOffer->setDateTime($value['dateTime']);
                    $jobOffer->setLimitDate($value['limitDate']);
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
            $query = "UPDATE joboffer SET name=:name, description=:description, dateTime=:dateTime, limitDate=:limitDate, timeState=:timeState, userState=:userState, idUser=:idUser, idJobPosition=:idJobPosition, idCompany=:idCompany WHERE  id_JobOffer = :id_JobOffer" ;

            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limitDate'] = $jobOffer->getLimitDate();
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
                $jobOffer->setDateTime($value['dateTime']);
                $jobOffer->setLimitDate($value['limitDate']);
                $jobOffer->setTimeState($value['timeState']);
                $jobOffer->setUserState($value['idUser']);

                $jobOffer->setUser($this->userDAO->GetUserXid($value['idUser']));
                $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
    
                array_push($listToReturn, $jobOffer);
            }
            return  $listToReturn;
        }

        public function GetJobOfferXid($idJobOffer){

            $query = " SELECT * FROM joboffer WHERE id_JobOffer = (:idJobOffer)"; //company WHERE id_Company = :idCompany";
    
            $parameters['idJobOffer'] = $idJobOffer;
    
            try {
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            $jobOffer = null;
    
            if(!empty($result)){
    
                foreach($result as $value){

                    $jobOffer = new JobOffer();

                    $jobOffer->setIdJobOffer($value['id_JobOffer']);
                    $jobOffer->setDescription($value['description']);
                    $jobOffer->setDateTime($value['dateTime']);
                    $jobOffer->setLimitDate($value['limitDate']);
                    $jobOffer->setTimeState($value['timeState']);
                    $jobOffer->setUserState($value['userState']);
    
                    $jobOffer->setUser($this->userDAO->GetUserXid($value['idUser']));
                    $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                    $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
                }
            }
            return $jobOffer;
        }


        public function modifyJobOffer($limitDate, $description, $idJobOffer) {

            $sql = "UPDATE joboffer SET description = :description , limitDate = :limitDate WHERE (id_JobOffer = :idJobOffer);" ;
            
            $parameters['limitDate'] = $limitDate;
            $parameters['description'] = $description;
            $parameters['idJobOffer'] = $idJobOffer;
            
            try {
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
            return $result; //si retorna 1 actualizó si retorna 0 no actualizó
        }

        public function applyToJobOffer($idUser, $idJobOffer) {
            
            if($idUser != 1){
                $applied = $this->updateApplyJobOffer($idUser, $idJobOffer);
            }
            return $applied; //si retorna 1 actualizó si retorna 0 no actualizó
        }

        public function updateApplyJobOffer($idUser, $idJobOffer)
        {
            $query = "UPDATE joboffer SET idUser=:idUser, userState=:userState WHERE (id_JobOffer = :idJobOffer);" ;

            $parameters['idUser'] = $idUser;
            $parameters['userState'] = 2; //inactive
            $parameters['idJobOffer'] = $idJobOffer;
            
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        }

        public function checkAlreadyApplied($idUser){
            $applied=1;
            $jobOfferList = $this->GetAll();

            foreach ($jobOfferList as $jobOff){
                if ($jobOff->getUser()->getId() == $idUser){
                    $applied=0;
                }
            }
            return $applied; // retorna 1 si no aplicó a ninguna job offer y 0 si ya esta presentado para una
        }

        public function cancelAplicationJobOffer($idJobOffer){
            $query = "UPDATE joboffer SET idUser=:idUser, userState=:userState WHERE (id_JobOffer = :idJobOffer);" ;

            $parameters['idUser'] = 1;
            $parameters['userState'] = 1; //active
            $parameters['idJobOffer'] = $idJobOffer;
            
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        }

        public function checkAppliedToSpecificJobOffer($idUser, $idJobOffer){
            $applied=0;
            $jobOfferList = $this->GetAll();

            foreach ($jobOfferList as $jobOff) {

                if (($jobOff->getUser()->getId() == $idUser) && ($jobOff->getIdJobOffer() == $idJobOffer)) {
                    $applied=1;
                }
            }
            return $applied; // retorna 1 si aplicó a la job offer especificada y 0 si no
        }

        public function checkIfCompanyIsAsociated($idCompany){
            $associated=false;
            $jobOfferList = $this->GetAll();

            foreach($jobOfferList as $jobOff){
                
                if($jobOff->getCompany()->getIdCompany() == $idCompany){
                    $associated=true;
                }
            }
            return $associated;
        }

    }

?>