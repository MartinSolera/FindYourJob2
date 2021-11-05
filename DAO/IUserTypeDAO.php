<?php
    namespace DAO;

    use Models\UserType as UserType;

    interface IUserTypeDAO 
    {
        function GetAll();
        function Add(UserType $userType);
        public function DeleteUserType($id_UserType);
    }
?> 