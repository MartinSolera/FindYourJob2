<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO 
    {
        function GetAll();
        function Add(User $user);
        public function DeleteUser($idUser);
    }
?> 