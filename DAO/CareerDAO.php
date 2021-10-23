<?php
    namespace DAO;

    use Models\Career as Career;
    use DAO\ICareerDAO as ICareerDAO;

    class CareerDAO implements ICareerDAO{

        private $careerList = array();

        public function __construct()
        {
    
        }

        public function GetAll(){

            $this->consumeFromApi();
            return $this->careerList;

        }

        public function Delete(Career $careerToDelete){

        }

        private function consumeFromApi(){
         
            $this->careerList = array();

            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: " . API_KEY)
            );

            $context = stream_context_create($options);

            $response = file_get_contents(API_URL .'Career', false, $context);

            $arrayToDecode = json_decode($response, true);
          
          foreach($arrayToDecode as $valuesArray){
            $career = new Career();
            $career->setCareerId($valuesArray['careerId']);
            $career->setDescription($valuesArray['description']);
            $career->setActive($valuesArray['active']);

            array_push($this->careerList, $career);

          }

        }

      public function GetAllActive(){
            $this->consumeFromApi();
            return array_filter(
                $this->careerList,
                fn($activeCareer) => $activeCareer->getActive() == true
             );

        }

        public function GetCareerById($careerId){
            $this->consumeFromApi();

            foreach ($this->careerList as $career) {
                if ($career->getCareerId() == $careerId){
                    return $career;
                }
            }
            return null;
    }

    public function getCareerStudent($student){
        $this->consumeFromApi();
            foreach($this->careerList as $career){
                if($student->getCareerId() == $career->getCareerId())
                return $career;
            }
        
    }

    }

?> 