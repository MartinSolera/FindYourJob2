<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Utils\Utils as Utils;
    use Models\JobPosition as JobPosition; 
    use Models\JobOffer as JobOffer;
    use Controllers\Functions;
use Exception;
use PDOException;

    class JobOfferController {

        private $jobOfferDAO;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
        }

        public function AddJobOfferView($message = "") {
            Utils::checkAdminSession();

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."addJobOffer.php");
        }

        public function JobOfferManagementView($message = "") {
            Utils::checkAdminSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-management.php");
        }

        public function JobOfferModifyView($idJobOffer) {
            Utils::checkAdminSession();

            $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);
            if($jobOffer->getUserState()==2){ 
                $message = "Cannot update job offer because a student has already applied";
                $this->JobOfferManagementView($message);
            }
            require_once(VIEWS_PATH."modifyJobOffer.php");
        }

        public function AddJobOffer($idCompany, $idJobPosition,  $datetime, $limitdate,$description)
        {
            Utils::checkAdminSession();

            $message=null;
            $company = $this->companyDAO->GetCompanyXid($idCompany);
            $jobPosition = $this->jobPositionDAO->GetJobPositionXid($idJobPosition);
            
            $newJobOff = new JobOffer();
            $newJobOff->setDescription($description);
            $newJobOff->setDatetime($datetime);
            $newJobOff->setLimitDate($limitdate);
            $newJobOff->setCompany($company);
            $newJobOff->setJobPosition($jobPosition);
            $newJobOff->setUserState(1); //disponible 
            $newJobOff->setTimeState(1);
            $newJobOff->setUser(1);
            
            try {
                $result = $this->jobOfferDAO->Add($newJobOff);
        
                if($result==1){
                    $message="Job offer added successfully";
                    
                    $this->AddJobOfferView($message);
                } else {
                    $message="error: failed to add the job offer";
                    $this->AddJobOfferView($message);
                }
            } catch (Exception $ex) {
                //if(Functions::contains_substr($ex->getMessage(), "Duplicate entry"))
                $message = $ex->getMessage();
                $this->AddJobOfferView($message);
            }
           
        }

        public function deleteJobOffer($idJobOffer) {
            Utils::checkAdminSession();
            $message = "Job offer deleted";
            
            $removed = $this->jobOfferDAO->DeleteJobOffer($idJobOffer);
            $this->JobOfferManagementView($message);
        }


        public function modifyJobOffer($limitDate, $description, $idJobOffer)
        {
            Utils::checkSession();
        
            $result=$this->jobOfferDAO->modifyJobOffer($limitDate, $description, $idJobOffer);
            
            if($result==1) {
                $message = "The job offer has been updated successfully";
                $this->JobOfferManagementView($message);
            } else {
                $message = "Error: could not update the job offer";
                $this->JobOfferManagementView($message);
            }
        }
        

         ///Filtro de job offers
        public function jobOffersForJobPosition($positionId){
            Utils::checkSession();
            $this->jobOfferList = $this->jobOfferDAO->GetAll();
            $results = array();
        
            foreach($this->jobOfferList as $offer){
                if($offer['jobPositionId'] == $positionId){
                        array_push($results, $offer); 
                    }
                }
                return $results;
            }
        

    }

?>