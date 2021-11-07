<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Utils\Utils as Utils;
    use Models\User as User; 
    use Models\JobOffer as JobOffer;
    use Controllers\ViewController as ViewController;
    use Controllers\Functions;
    use Exception;

    class JobOfferController {

        private $jobOfferDAO;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;
        private $viewController;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
            $this->viewController = new ViewController();
        }

        public function addJobOfferView($message = "") {
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
            }else{
                require_once(VIEWS_PATH."modifyJobOffer.php");
            }
            
        }

        public function AddJobOffer($idCompany, $idJobPosition,  $datetime, $limitdate,$description)
        {
            Utils::checkSession();
            if (($limitdate >= date("Y-m-d") && ($datetime>= date("Y-m-d"))))
            {
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
                        
                        $this->addJobOfferView($message);
                    } else {
                        $message="error: failed to add the job offer";
                        $this->addJobOfferView($message);
                    }
                } catch (Exception $ex) {
                    //if(Functions::contains_substr($ex->getMessage(), "Duplicate entry"))
                    $message = $ex->getMessage();
                    $this->addJobOfferView($message);
                }
            } else{            
                $invalidDate = true;
                $companyList = $this->companyDAO->GetAll();
                $jobPositionList = $this->jobPositionDAO->GetAll();
                require_once(VIEWS_PATH . "addJobOffer.php");
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

        public function filterJobOffersForJobPosition($search){
            
            $search = strtolower($search); //paso a minuscula la busqueda
            $filteredJobOffers = array();  //creo un array para las job offer que filtre
            foreach ($this->jobOfferDAO->getAll() as $jobOffer) 
            {
                $jobPosDescription = strtolower($jobOffer->getJobPosition()->getDescription()); //creo una variable para comparar con la busqueda, con la descripcion de la job position
                
                if (Utils::completeSearch($jobPosDescription, $search)) //si coinciden agrego la busqueda al array de las job offer que coinciden con las posiciones filtradas
                {
                    array_push($filteredJobOffers, $jobOffer);
                }            
            }
            $jobOfferList = $filteredJobOffers;
            if($jobOfferList == null){
                $this->jobOfferList("The job position you are searching for doesn't exist");
            }
            require_once(VIEWS_PATH."list-JobOffers-std.php");
        }
     
        
        public function showJobOffer($idJobOffer) {

            Utils::checkSession();
            
            $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);
        
            require_once(VIEWS_PATH."jobOffer-show.php");
        }

        public function jobOfferList($message = "") {
            Utils::checkSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."list-jobOffers-std.php");
        }


        public function apply($idJobOffer) {
            
            $idUser = Utils::getIdUser();
            $alreadyApp=$this->jobOfferDAO->checkAlreadyApplied($idUser);

            if($alreadyApp == 1){
                $result = $this->jobOfferDAO->applyToJobOffer($idUser, $idJobOffer);

                if($result == 1){
                    $message = "applied successfully";
                }
                else{
                    $message = "could not apply, try again later";
                }
            }else{
                $applied=$this->jobOfferDAO->checkAppliedToSpecificJobOffer($idUser, $idJobOffer);
                if($applied == 1){
                    $message = "you have already applied to this job offer";
                } else{
                    $message = "you have already applied to another job offer";
                }   
            }
            
            $this->jobOfferList($message);
        }
        
        public function cancelApplication ($idJobOffer){
            $idUser = Utils::getIdUser();
            $alreadyApp=$this->jobOfferDAO->checkAppliedToSpecificJobOffer($idUser, $idJobOffer);

            if($alreadyApp == 1){
                $result = $this->jobOfferDAO->cancelAplicationJobOffer($idJobOffer);

                if($result == 1){
                    $message = "cancelled your application successfully";
                }
                else{
                    $message = "could not cancel your application, try again later";
                }
            }else{
                $applied = $this->jobOfferDAO->checkAlreadyApplied($idUser);//si ya aplico a otra oferta de trabajo que no es la actual
                if($applied == 0){
                    $message = "you have already applied to another job offer";
                } else{
                    $message = "you haven't already applied to a job offer";
                }
            }
            
            $this->jobOfferList($message);
        }



    }

?>