<?php
    namespace Models;

    class JobOffer {

        private $idJobOffer;
        private $student;
        private $company;
        private $jobPosition;
        private $description;
        private $datetime;
        private $limit_date;
        private $timeState;
        private $studentState;

        public function setIdJobOffer($idJobOffer){
            $this->idJobOffer = $idJobOffer;
        }

        public function getIdJobOffer(){
            return $this->idJobOffer;
        }

        public function setStudent($student){
            $this->student = $student;
        }

        public function getStudent(){
            return $this->student;
        }

        public function setCompany($company){
            $this->company = $company;
        }

        public function getCompanyId_JobOffer(){
            return $this->companyId_JobOffer;
        }

        public function setJobPositionId_JobOffer($jobPositionId){
            $this->jobPositionId_JobOffer = $jobPositionId;
        }

        public function getJobPositionId_JobOffer(){
            return $this->jobPositionId_JobOffer;
        }

        public function setDescription($description){
            $this->description = $description;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDatetime($datetime){
            $this->datetime = $datetime;
        }

        public function getDatetime(){
            return $this->datetime;
        }

        public function setLimitDate($limit_date){
            $this->limit_date = $this->limit_date;
        }

        public function getLimitDate(){
            return $this->limit_date;
        }

        public function setTimeState ($timeState){
            $this->timeState = $timeState;
        }

        public function getTimeState(){
            return $this->timeState;
        }

        public function setStudentState($studentState){
            $this->studentState = $studentState;
        }

        public function getStudentState(){
            return $this->studentState;
        }

    }


?>