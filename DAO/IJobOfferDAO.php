<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        function Add(JobOffer $jobOffer);
        function GetAll();
        function DeleteJobOffer($id_jobOffer);
    }
?>