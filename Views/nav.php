<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
<script src="https://kit.fontawesome.com/4fa39b8df5.js" crossorigin="anonymous"></script>
     <div >
		<a href="https://mdp.utn.edu.ar" title="Sitio Oficial" target="_blank" > <img src="<?php echo IMG_PATH ?>utnLogo.png" padding="500px" width="50" height="" alt=""  /></a>
	</div>
     <span class="navbar-text">
          <strong > FindYourJob</strong>
     </span>
     <ul class="navbar-nav ml-auto">

          <!-- -----------Admin---------------- -->
          
          <?php if(isset($_SESSION['admin'])) { ?>
          
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>View/showAdminMenu"> <i class="fas fa-home"> </i> Menu</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/JobOfferManagementView"><i class="fas fa-list"></i> Job offer management</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/addJobOfferView"><i class="fas fa-plus-square"> </i> Add job offer </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin"><i class="fas fa-list"></i> Company management</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ViewAddCompany"><i class="fas fa-plus-square"> </i> Add company </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>View/LogOut">Logout <i class="fas fa-sign-out-alt"></i> </a>
          </li> 
          <?php } ?>   
          
          <!-- -----------Student---------------- -->

          <?php if(isset($_SESSION['student'])) { ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>View/showStudentMenu">Menu <i class="fas fa-home"> </i></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferList">Job Offers List <i class="fas fa-list"></i></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent">Companies List <i class="fas fa-list"></i></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>View/LogOut">Logout <i class="fas fa-sign-out-alt"></i></a>
          </li> 
          <?php } 
          ?>

     </ul>
</nav>