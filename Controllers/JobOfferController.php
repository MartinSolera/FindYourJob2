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

            
            require_once(VIEWS_PATH."addJobOffer.php");
        }

        public function JobOfferManagementView($message = "") {
            Utils::checkAdminSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-management.php");
        }

        public function AddJobOffer($description, $datetime, $limitDate, $idCompany, $idJobPosition)
        {
            Utils::checkAdminSession();
            $message=null;

            if($description != "" && $datetime != "" && $limitDate != "" && $idJobPosition && $idCompany != "" )
            {
                $newJobOff = new JobOffer();
                $newJobOff->setDescription($description);
                $newJobOff->setDatetime($datetime);
                $newJobOff->setLimitDate($limitDate);
                $newJobOff->setCompany($this->companyDAO->GetCompanyXid($idCompany));
                $newJobOff->setJobPosition($this->jobPositionDAO->GetJobPositionXid($idJobPosition));
                $newJobOff->setUserState(0); //disponible 
                $newJobOff->setTimeState(0);
                $newJobOff->setUser(null);

                try {
                    $result = $this->JobOfferDAO->Add($newJobOff);
                    if($result==1){
                        $message="Job offer added successfully";
                        $this->AddJobOfferView($message);
                    } else {
                        $message="error: failed to add the job offer";
                        $this->AddJobOfferView($message);
                    }
                } catch (PDOException $ex) {
                    if(Functions::contains_substr($ex->getMessage(), "Duplicate entry"))
                    $message = $ex->getMessage();
                    $this->AddJobOfferView($message);
                }
            }
        }

        public function DeleteJobOffer($idJobOffer) {
            Utils::checkAdminSession();
            $message = "Company deleted";
            
            $removed = $this->JobOfferDAO->DeleteJobOffer($idJobOffer);
            $this->JobOfferManagementView($message);
        }

        

              ///Filtro de job offers
        public function jobOffersForJobPosition($positionId){
            Utils::checkSession();
            $this->jobOfferList = $this->jobOfferDAO->GetAllJobPosition();
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