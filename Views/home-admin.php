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
            
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">


                <div class="btn-group me-2" role="group" aria-label="Second group">    
                    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>JobOffer/JobOfferManagementView">Job Offer Management</a>
                    <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>JobOffer/AddJobOfferView">Add Job Offer</a>
                </div>

                <div class="btn-group" role="group" aria-label="Third group">
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin" >Company Management</a>
                    <a class="btn btn-info" href="<?php echo FRONT_ROOT ?>Company/ViewAddCompany" >Add Company</a>
        
                </div>

                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a class="btn btn-dark" href="<?php echo FRONT_ROOT ?>Update/UpdateDB" >Update Data</a>
                    <a class="btn btn-primary" href="<?php echo FRONT_ROOT ?>Student/ShowStudentList" >Students List</a>
                    
                </div>
            </div>
        </div>

    </header>

</body>
