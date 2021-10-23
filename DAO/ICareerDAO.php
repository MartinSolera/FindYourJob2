<?php
    namespace DAO;

    use Models\Career as Career;

    interface ICareerDAO 
    {
        function GetAll();  
        function GetAllActive(); 
        function Delete(Career $career);
    }
?> 