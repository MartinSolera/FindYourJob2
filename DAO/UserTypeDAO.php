<?php
    namespace DAO;
    use Models\UserType as UserType;
    use DAO\Connection as Connection;
    use FFI\Exception;

    class UserTypeDAO {

        private $connection;
        private $nameTable;
   
        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "usertype";
        }

        public function Add(UserType $userType){
            $query = " INSERT INTO ". $this->nameTable . " (description) value (:description)";
    
            $parameters['description'] = $userType->getDescription();          

            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
            return $result;
        }

        public function GetAll() {
            $listUserTypes = [];

            $query = "SELECT * FROM" . $this->nameTable;

            try {
                $result = $this->connection->Execute($query);
            } catch (Exception $ex){
                throw $ex;
            }

            if(!empty($result)) { 
                foreach($result as $value) {

                    $userType = new UserType();

                    $userType->setDescription($value['description']);
                    
                    array_push($listUserTypes, $userType);
                }
            }
            return $listUserTypes;
        }

        public function DeleteUserType($id_UserType)
        {
            $sql = "DELETE FROM user WHERE id_UserType = :id_UserType";
            $parameters['id_UserType'] = $id_UserType;
     
            try {
                $this->connection = Connection::getInstance();
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
    
            }catch (\PDOException $ex) {
                throw $ex;
            }
        }

        
        public function GetUserTypeXid ($id_UserType){
            $query = " SELECT * FROM " . $this->nameTable . " where id_UserType =( :id_UserType)";
    
            $parameters['id_UserType'] = $id_UserType;
            try{
                $result = $this->connection->Execute($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }

            $userT = null;

            if(!empty($result)){
                foreach($result as $value){
                    $userT = new UserType();

                    $userT->setId($value['id_UserType']);
                    $userT->setDescription($value['description']);
                }
            }
            return $userT;
        }

        
    }
?>