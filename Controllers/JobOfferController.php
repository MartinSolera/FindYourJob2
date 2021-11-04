<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Utils\Utils as Utils;
    use Models\User as User; 
    use Models\JobOffer as JobOffer;
    use Controllers\Functions;
    use Exception;

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
            Utils::checkSession();

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."addJobOffer.php");
        }

        public function JobOfferManagementView($message = "") {
            Utils::checkSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-management.php");
        }

        public function JobOfferModifyView($idJobOffer) {
            Utils::checkSession();

            $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);
            if($jobOffer->getUserState()==2){ 
                $message = "Cannot update job offer because a student has already applied";
                $this->JobOfferManagementView($message);
            }
            require_once(VIEWS_PATH."modifyJobOffer.php");
        }

        public function AddJobOffer($idCompany, $idJobPosition,  $datetime, $limitdate,$description)
        {
            Utils::checkSession();
        
            $message=null;
            $company = $this->companyDAO->GetCompanyXid($idCompany);
            $jobPosition = $this->jobPositionDAO->GetJobPositionXid($idJobPosition);
            $user = $this->userDAO->GetUserXid(1); //id admin

            $newJobOff = new JobOffer();
            $newJobOff->setDescription($description);
            $newJobOff->setDatetime($datetime);
            $newJobOff->setLimitDate($limitdate);
            $newJobOff->setCompany($company);
            $newJobOff->setUser($user);
            $newJobOff->setJobPosition($jobPosition);
            $newJobOff->setUserState(1); //disponible 
            $newJobOff->setTimeState(1); //disponible
            
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
            Utils::checkSession();
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
        

        //Filtro de job offers
        public function filterJobOffersForJobPosition($search){
            
            $search = strtolower($search);
            $filteredJobPositions = array();
            foreach ($this->jobPositionDAO->getAll() as $jobPosition) 
            {
                $jobPosDescription = strtolower($jobPosition->getDescription());
    
                if (Utils::completeSearch($jobPosDescription, $search)) 
                {
                    array_push($filteredJobPositions, $jobPosition);
                }            
            }
            $jobOffers = $filteredJobPositions;
            if($jobOffers == null){
                $this->jobOfferList("The job offer you are searching for doesn´t exist");
            }
            require_once(VIEWS_PATH."list-JobOffers-std.php");
        }
        
        public function showJobOffer($idJobOffer) {

            Utils::checkSession();

            $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);
        
            require_once(VIEWS_PATH."show-jobOffer.php");
        }

        public function jobOfferList($message = "") {
            Utils::checkSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."list-jobOffers-std.php");
        }


        public function apply($idUser, $idJobOffer) {
            
            $result = $this->jobOfferDAO->applyToJobOffer($idUser, $idJobOffer);
            if($result == 1){
                $message = "applied successfully";
            }
            else{
                $message = "could not apply";
            }
            $this->jobOfferList($message);
        }
        




    }

?>