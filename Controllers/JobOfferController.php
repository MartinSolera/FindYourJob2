<?php

    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Utils\Utils as Utils;
    use Models\JobPosition as JobPosition; 
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    class JobOfferController {

        private $jobOfferDAO;
        private $jobPositionDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
        }

        public function FormAddJobOffer() {
            Utils::checkAdminSession();

            $jobPositionList = $this->jobPositionDAO->GetAll();
            require_once(VIEWS_PATH."addJobOffer.php");
        }

        public function addJobOffer($description, $datetime, $limit_date, $jobPositionId_JobOffer)
        {
            if($description != "" && $datetime != "" && $limit_date != "" && $jobPositionId_JobOffer != "")
            {
                $newJobOff = new JobOffer();
                $newJobOff->setDescription($description);
                $newJobOff->setDatetime($datetime);
                $newJobOff->setLimitDate($limit_date);
                $newJobOff->setJobPositionId_JobOffer($jobPositionId_JobOffer);
                
                $this->jobOfferDAO->add($newJobOff);
                $this->FormAddJobOffer(); 
                //habria q agregar para mostrar comentario de exito/error
            }
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


        

    }

?>