<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDAO
    {
        function GetAll();
        function Add(JobPosition $jobPosition);
    }
?>