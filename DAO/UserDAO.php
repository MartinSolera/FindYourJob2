<?php
    namespace DAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO {

        private $connection;
        private $nameTable;
   
        public function __construct(){
            $this->connection = Connection::GetInstance();
            $this->nameTable = "user";
        }

        
    }

?>