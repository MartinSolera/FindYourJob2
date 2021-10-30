<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
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
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAdminMenu">Menu</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin">Company management</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ViewAddCompany">Add company </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/LogOut">Logout</a>
          </li> 
          <?php } ?>   
          
          <!-- -----------Student---------------- -->
         

          <?php if(isset($_SESSION['student'])) { ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowStudentMenu">Menu</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent">Companies List</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/LogOut">Logout</a>
          </li> 
          <?php } 
          ?>

     </ul>
</nav>