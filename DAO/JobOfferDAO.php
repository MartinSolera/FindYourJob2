<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use DAO\Connection as Connection;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\User as User;
    use FFI\Exception;

    class JobOfferDAO implements IJobOfferDAO {

        private $connection;
        private $nameTable;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;
        private $studentList;

        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "joboffer";
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
            $this->studentList = array();
        }

        public function Add(JobOffer $jobOffer) {
            $query = "INSERT INTO joboffer (description, dateTime, limitDate, timeState, idJobPosition, idCompany) value (:description, :dateTime, :limitDate, :timeState, :idJobPosition, :idCompany);";
            
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limitDate'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
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
                    $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                    $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
                    
                    array_push($listJobOffers, $jobOffer);
                }
            }
            return  $listJobOffers;
        }

        public function getStudentList(){
            $studentList = array();

            $query = "SELECT * FROM user_x_joboffer" ;

            try {
                $result = $this->connection->Execute($query);
    
            } catch (Exception $ex) {
                throw $ex;
            }

            if(!empty($result)) {
    
                foreach($result as $value){

                    $user = new User();
                    $user = $this->userDAO->GetUserXid($value['idUser']);

                    array_push( $studentList, $user);
                }
            }
            return $studentList;
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
            $query = "UPDATE joboffer SET name=:name, description=:description, dateTime=:dateTime, limitDate=:limitDate, timeState=:timeState, idJobPosition=:idJobPosition, idCompany=:idCompany WHERE  id_JobOffer = :id_JobOffer" ;

            $parameters['description'] = $jobOffer->getDescription();
            $parameters['dateTime'] = $jobOffer->getDateTime();
            $parameters['limitDate'] = $jobOffer->getLimitDate();
            $parameters['timeState'] = $jobOffer->getTimeState();
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

                //$jobOffer->setUser($this->userDAO->GetUserXid($value['idUser']));
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
                    /* 
                    $user = $this->userDAO->GetUserXid($value['idUser']);
                    if($user!=null){
                        $jobOffer->setUser($this->userDAO->GetUserXid($value['idUser']));
                    }
                    */
                    $jobOffer->setCompany($this->companyDAO->GetCompanyXid($value['idCompany']));
                    $jobOffer->setJobPosition($this->jobPositionDAO->GetJobPositionXid($value['idJobPosition']));
                }
            }
            return $jobOffer;
        }

        /* public function getPostulationById */

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

        public function applyToJobOffer($idUser, $idJobOffer)
        {
            $query =  "INSERT INTO user_x_joboffer (idUser, idJobOffer) value (:idUser, :idJobOffer);";

            $parameters['idUser'] = $idUser;
            $parameters['idJobOffer'] = $idJobOffer;
            
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            } 
        } //si retorna 1 insertó bien si no retorna 0 


        public function cancelAplicationJobOffer($idJobOffer, $idUser){
            $query = "DELETE FROM user_x_joboffer WHERE idUser = :idUser AND idJobOffer = :idJobOffer;";

            $parameters['idUser'] = $idUser;
            $parameters['idJobOffer'] = $idJobOffer;

            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        } //si retorna 1 elimino, si no retorna 0

        /* public function checkAlreadyAppliedToSpecificJobOffer($idUser, $idJobOffer){

            $query = "SELECT idUserXjoboffer FROM user_x_joboffer WHERE idUser = :idUser AND idJobOffer = :idJobOffer " ;

            $parameters['idUser'] = $idUser;
            $parameters['idJobOffer'] = $idJobOffer;

            try {
                $result = $this->connection->Execute($query);
    
            } catch (Exception $ex) {
                throw $ex;
            }
            return $result; // retorna 1 si existe el registro o 0 si no existe
        }
        */

        public function checkAlreadyAppliedToSpecificJobOffer($idUser, $idJobOffer){

            $query = "SELECT * FROM user_x_joboffer WHERE idJobOffer = :idJobOffer"; 
    
            $parameters['idJobOffer'] = $idJobOffer;
    
            try {
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            $applied = null;
    
            if(!empty($result)){
    
                foreach($result as $value){

                    if($value['idJobOffer']==$idJobOffer && $value['idUser']==$idUser){
                        $applied=true;
                    }
                }
            }
            return $applied;
        }

        /* public function checkAppliedToSpecificJobOffer($idUser, $idJobOffer){
            $applied=0;
            $jobOfferList = $this->GetAll();

            foreach ($jobOfferList as $jobOff) {
                if($jobOff->getUser()!=null){
                    if (($jobOff->getUser()->getId() == $idUser) && ($jobOff->getIdJobOffer() == $idJobOffer)) {
                        $applied=1;
                    }
                }
            }
            return $applied; // retorna 1 si aplicó a la job offer especificada y 0 si no
        } */

        /* public function cancelAplicationJobOffer($idJobOffer){
            $query = "UPDATE joboffer SET idUser=:idUser WHERE (id_JobOffer = :idJobOffer);" ;

            //llamar funcion para eliminar registro de la tabla user_x_joboffer
            $parameters['idUser'] = null;
            $parameters['idJobOffer'] = $idJobOffer;
            
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($query, $parameters);
            } catch (Exception $exception) {
                throw $exception;
            }
        } */

        

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

        public function getJobOfferXidApplicant($idUser){
            $jobOfferList = $this->GetAll();
            $idJobOffer=null;

            foreach($jobOfferList as $jobOff){
                if($jobOff->getUser() != null){
                    if($jobOff->getUser()->getId() == $idUser){
                        $idJobOffer=$jobOff->getIdJobOffer();
                    }
                }
            }
            return $idJobOffer;
        }

    }

?>