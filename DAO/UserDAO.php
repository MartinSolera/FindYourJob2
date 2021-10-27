<?php
    namespace DAO;
    use Models\User as User;
    use DAO\Connection as Connection;
    use FFI\Exception;

    class UserDAO {

        private $connection;
        private $nameTable;
   
        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "user";
        }

        public function Add(User $user){
            $query = " INSERT INTO ". $this->nameTable . " (email , password , idUserType) value (:email , :password , :idUserType)";
    
            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            $parameters['idUserType'] = $user->getUserType()->getId();

            try {
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
    
            } catch (\PDOException $ex) {
                throw $ex;
            }
            return $result;
        }

        public function GetAll() {
            $listUsers = [];

            $query = "SELECT * FROM" . $this->nameTable;

            try {
                $result = $this->connection->Execute($query);
            } catch (\PDOException $ex){
                throw $ex;
            }

            if(!empty($result)) { 
                foreach($result as $value) {
                    $user = new User();

                    $user->setEmail($value['email']);
                    $user->setPassword($value['password']);
                    $user->setUserType($this->userTypeDAO->GetUserTypeXid($value['idUserType']));
                    $user->setId($value['id_User']);
                    
                    array_push($listUsers, $user);
                }
            }
            return $listUsers;
        }

        public function DeleteUser($idUser)
        {
            $sql = "DELETE FROM user WHERE id_User = :id_User";
            $parameters['id_User'] = $idUser;
     
            try {
                $this->connection = Connection::getInstance();
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
    
            }catch (\PDOException $exception) {
                throw $exception;
            }
        }

        public function getUserByEmail($email){
            $userExist = NULL;
            $users = $this->GetAll();

            foreach($users as $user){
                if($user->getEmail() == $email){
                    $userExist = $user;
                }
            }
            return $userExist;
        }

        public function GetUserXid($idUser) {

            $query = " SELECT * FROM " . $this->nameTable . " WHERE id_User = (:id_User)";
    
            $parameters['id_User'] = $idUser;
    
            try {
                $result = $this->connection->Execute($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
    
            $user = null;
    
            if(!empty($result)){
    
                foreach($result as $value){

                    $user = new User();

                    $user->setEmail($value['email']);
                    $user->setPassword($value['password']);
                    $user->setUserType($this->userTypeDAO->GetUserTypeXid($value['idUserType']));
                    $user->setId($value['id_User']);
                }
            }
            return $user;
        }
    }

?>