<?php
    namespace Models;

    class JobPosition {

        private $jobPositionId;
        private $careerId;
        private $description;

        public function getJobPositionId(){
            return $this->jobPositionId;
        }

        public function setJobPositionId($jobPositionId){
            $this->jobPositionId = $jobPositionId;
        }

        public function getCareerId(){
            return $this->careerId;
        }

        public function setCareerId($careerId){
            $this->careerId = $careerId;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->description = $description;
        }
    }


?>