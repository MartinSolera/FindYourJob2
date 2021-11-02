<?php
 require_once('nav.php');
?>

<body>
<header class="text-center">
    <br><br>
<img src="<?php echo IMG_PATH ?>studentMenu.png" width="200" height="" alt=""/>
       </header>
    <!-- Header-->
    <br><br>
    <header class="d-flex align-items-center justify-content-center height-50">   
                    
    
        <div class="container-menu px-8 px-lg-1 text-center ">
        <!-- <div class="view-container"> -->
     
        <h1 p class="text-primary" class="mb-1">Welcome</h1>
        
            <h2> Home Student </h2>
            <h5 class="mb-5"><em>Please choose one of the next actions</em></h5>
            
            <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Student/ShowStudentList">Student List</a>

            <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent">Show Companies View</a>

            <a class="btn btn-success btn-x2" href="<?php echo FRONT_ROOT ?>Student/JobOfferManagment">Job Offers List</a>
            

        </div>
    </header>

</body>
