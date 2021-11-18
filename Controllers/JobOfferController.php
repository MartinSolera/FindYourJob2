<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\StudentDAO as StudentDAO;
    use Utils\Utils as Utils;
    use Models\JobOffer as JobOffer;
    use Models\PDF as PDF;
    use Controllers\ViewController as ViewController;
    use Exception;

    class JobOfferController {

        private $jobOfferDAO;
        private $jobPositionDAO;
        private $userDAO;
        private $companyDAO;
        private $viewController;
        private $studentDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
            $this->viewController = new ViewController();
            $this->studentDAO = new StudentDAO();
        }

        public function addJobOfferView($message = "") {
            Utils::checkSession();

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."addJobOffer.php");
        }

        public function addJobOfferByCompanyView($message = "") {
            Utils::checkSession();
            $emailCompany = Utils::getUserEmail();
            $exists = $this->companyDAO->checkIfEmailAlreadyExists($emailCompany); // retorna 1 si el email ya le corresponde a una company cargada y 0 si no
            if($exists==1){
                $company = $this->companyDAO->GetCompanyXEmail($emailCompany);
            }

            $companyList = $this->companyDAO->GetAll();
            $jobPositionList = $this->jobPositionDAO->GetAll();

            require_once(VIEWS_PATH."addJobOfferByCompany.php");
        }

        public function JobOfferManagementView($message = "") {
            Utils::checkSession();

            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-management.php");
        }

        public function JobOfferModifyView($idJobOffer) {
            Utils::checkSession();

            $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);
            /* if($jobOffer->getUserState()==2){ 
                $message = "Cannot update job offer because a student has already applied";
                $this->JobOfferManagementView($message);
            }else{
                require_once(VIEWS_PATH."modifyJobOffer.php");
            } */ 
            require_once(VIEWS_PATH."modifyJobOffer.php");
        }

        public function AddJobOffer($idCompany, $idJobPosition,  $datetime, $limitdate,$description, $flyer)
        {
            Utils::checkSession();
            if (($limitdate >= date("Y-m-d")) && ($datetime>= date("Y-m-d")))
            {
                $message=null;
                $company = $this->companyDAO->GetCompanyXid($idCompany);
                $jobPosition = $this->jobPositionDAO->GetJobPositionXid($idJobPosition);
                /* $user = $this->userDAO->GetUserXid(1);  *///id admin
 
                $newJobOff = new JobOffer();
                $newJobOff->setDescription($description);
                $newJobOff->setDatetime($datetime);
                $newJobOff->setLimitDate($limitdate);
                $newJobOff->setCompany($company);
                /* $newJobOff->setUser($user); */
               
                $newJobOff->setJobPosition($jobPosition);
                $newJobOff->setTimeState(1); //disponible
                $newJobOff->setFlyer($flyer);
                $newJobOff->setNotified(0);
                
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
            $alreadyApp = $this->jobOfferDAO->checkAlreadyAppliedToSpecificJobOffer($idUser, $idJobOffer);

            if($alreadyApp == true){
                $message = "you have already applied to this job offer";
            }
            else{
                $result = $this->jobOfferDAO->applyToJobOffer($idUser, $idJobOffer);

                if($result == 1){
                    $message = "applied successfully";
                }
                else{
                    $message = "could not apply, try again later";
                }
            }
            $this->jobOfferList($message);
        }
        
        public function cancelApplication ($idJobOffer){
            $idUser = Utils::getIdUser();
            $alreadyApp=$this->jobOfferDAO->checkAlreadyAppliedToSpecificJobOffer($idUser, $idJobOffer);

            if($alreadyApp == true){
                $result = $this->jobOfferDAO->cancelAplicationJobOffer($idUser, $idJobOffer);

                if($result == 1){
                    $message = "cancelled your application successfully";
                }
                else{
                    $message = "could not cancel your application, try again later";
                }
            }else{
                $message = "you haven't already applied to a job offer";
            }
            $this->jobOfferList($message);
        }

        public function applicantsList($idJobOffer){
            Utils::checkSession();
            $userStudentList=$this->userDAO->GetAllStudentType();
            $studentsList = $this->studentDAO->GetAll();
            $postulationsList = $this->jobOfferDAO->postulationsListForSpecificJobOffer($idJobOffer);//postulaciones para esta job offer
            
            if($postulationsList==null){ 
                $message = "no student has applied to this job offer";
                $this->JobOfferManagementView($message);
            }else{
                require_once(VIEWS_PATH."postulations-list.php");
            }
        }

        public function declineApplication($idStudent, $idJobOffer){
            Utils::checkSession();
            
            $applied = $this->jobOfferDAO->checkAlreadyAppliedToSpecificJobOffer($idStudent, $idJobOffer);

            if($applied == 1){
                $result = $this->jobOfferDAO->cancelAplicationJobOffer($idJobOffer, $idStudent);
                if($result == 1){
                    $student = $this->userDAO->GetUserXid($idStudent);
                    $jobOffer = $this->jobOfferDAO->GetJobOfferXid($idJobOffer);

                    $message = "declined the application of ".$student->getEmail();
                    $this->jobOfferDAO->generateDeclinedApplicationEmail($student, $jobOffer);

                    $this->JobOfferManagementView($message);
                }
                else{
                    $message = "cannot decline this student application now, try again later";
                    $this->JobOfferManagementView($message);
                }
            }else{
                $message = "the selected student has not applied to this job offer";
                $this->JobOfferManagementView($message);
            }
        }

        public function notifyEndedJobOffersToStudents(){
            Utils::checkSession();

            $this->jobOfferDAO->notifyEndedJobOffers();
            $this->viewController->showAdminMenu();
        }

        public function createPdfAppliedStudents($idJobOffer){

            Utils::checkSession();

            $postulationsList = $this->jobOfferDAO->postulationsListForSpecificJobOffer($idJobOffer);

            $studentsList = $this->studentDAO->getAll();

            $userStudentList=$this->userDAO->GetAllStudentType();

            //Creación del objeto de la clase heredada
            $pdf = new PDF();
            $pdf->AliasNbPages();// numeros paginas 
            $pdf->AddPage();
            $pdf->SetFont('Times','',12);

            if(!empty($userStudentList)){ 
                foreach($userStudentList as $userS){ 
                    foreach($studentsList as $student){ 
                        foreach($postulationsList as $idStudentP){
                            if($userS->getId() == $idStudentP){
                                if($student->getEmail() == $userS->getEmail()){ 

                                    $pdf->Cell(40,10,$student->getFileNumber(),1,0,'C',0);
                                    $pdf->Cell(40,10,$student->getFirstName(),1,0,'C',0);
                                    $pdf->Cell(40,10,$student->getLastName(),1,0,'C',0);
                                    $pdf->Cell(70,10,$student->getEmail() ,1,1,'C',0); 
                                }
                            }
                        }
                    }
                }
            }
            $pdf->Output();
        }

    }

?>