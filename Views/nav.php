<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
<script src="https://kit.fontawesome.com/4fa39b8df5.js" crossorigin="anonymous"></script>
     <div >
		<a href="https://mdp.utn.edu.ar" title="Sitio Oficial">
            <img width="180" height="" padding="500px" src="https://mdp.utn.edu.ar/wp-content/uploads/2021/02/UTN_IsoLogoBcoNeg.png"  alt="" loading="lazy" srcset="https://mdp.utn.edu.ar/wp-content/uploads/2021/02/UTN_IsoLogoBcoNeg.png 512w, https://mdp.utn.edu.ar/wp-content/uploads/2021/02/UTN_IsoLogoBcoNeg-300x98.png 300w" sizes="(max-width: 512px) 100vw, 512px"  >								
          </a>
	</div>
     <span class="navbar-text">
          <strong> FindYourJob</strong>
     </span>
     <ul class="navbar-nav ml-auto">

          <!-- -----------Admin---------------- -->


          <?php if(isset($_SESSION['admin'])) { ?>
          
           <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAdminMenu"> <i class="fas fa-home"> </i> Menu</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin"><i class="fas fa-list"></i> Company management</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ViewAddCompany"><i class="fas fa-plus-square"> </i> Add company </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/LogOut">Logout <i class="fas fa-sign-out-alt"></i> </a>
          </li> 
          <?php } ?>   
          
          <!-- -----------Student---------------- -->
         

          <?php if(isset($_SESSION['student'])) { ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowStudentMenu">Menu <i class="fas fa-home"> </i></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent">Companies List <i class="fas fa-list"></i></a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/LogOut">Logout <i class="fas fa-sign-out-alt"></i></a>
          </li> 
          <?php } 
          ?>

     </ul>
</nav>