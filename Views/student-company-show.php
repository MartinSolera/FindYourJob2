<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="bg-light-alpha p-5">
               <?php
                    if(isset($company))
                    {
                         echo  "<h3>Company: " . $company->getName() . "</h3><br>";
                         echo  "<h4> Year Foundation: " . $company->getYearFoundation() . "</h4>";
                         echo  "<h4> City: " . $company->getCity()->getName() . "</h4>";
                         echo  "<h4> Description: " . $company->getDescription() . "</h4>";
                         echo  "<h4> Email: " . $company->getEmail() . "</h4>";
                         echo  "<h4> PhoneNumber: " . $company->getPhoneNumber() . "</h4>";
                        ?> 
                         <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" alt="" width="90" height="60">
                         <?php
                    }
               ?>     
               </div>          
          </div>
     </section>
</main>