<?php
 require_once('nav.php');
?>

<body>
<header class="text-center">
    <br><br>
<img src="<?php echo IMG_PATH ?>homeAdmin.png" width="200" height="" alt=""/>
       </header>
    <!-- Header-->
    <br><br>
    <header class="d-flex align-items-center justify-content-center height-50">   
                    
    
        <div class="container-menu px-8 px-lg-1 text-center ">
        <!-- <div class="view-container"> -->
     
        <h1 p class="text-primary" class="mb-1">Welcome</h1>
        
            <h2> Administrator </h2>
            <h5 class="mb-5"><em>Please choose one of the next actions</em></h5>
            <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Company/ViewAddCompany">Add Company</a>
           <!-- <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Company/RedirectDeleteForm">Delete Company</a>  -->
            <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin">Company Management</a>
             <!--<a class="btn btn-primary btn-xl" href="#">Lista de Propuestas</a>-->
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>Student/ShowStudentList">Students List</a>
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>Update/UpdateDB">Update data</a>
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/JobOfferManagementView">Job Offer Management</a>
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/AddJobOfferView">Add Job Offer</a>
            
        </div>
    </header>

</body>
