<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="bg-light-alpha p-5" >
               <?php
                    if(isset($company))
                    {
                         echo  "<h3><b>Company: " . $company->getName() . "</h3></b>";
                         ?><br>
                         <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" width="120" height="80"><br>
                         <br>
                         <?php
                         echo  "<h5><b> Year Foundation: </b>" . $company->getYearFoundation() . "</h5>";
                         echo  "<h5><b> City: </b>" . $company->getCity()->getName() . "</h5>";
                         echo  "<h5><b> Description: </b>" . $company->getDescription() . "</h5>";
                         echo  "<h5><b> Email: </b> " . $company->getEmail() . "</h5>";
                         echo  "<h5><b> PhoneNumber: </b>" . $company->getPhoneNumber() . "</h5>";
  
                    }
                    ?>
                  
               </div>          
          </div>
     </section>
</main>