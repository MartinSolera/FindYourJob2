<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

            <?php
                    if(isset($company))
                    {
                         echo  "<h4> Name: " . $company->getName() . "</h4>";
                         echo  "<h4> Year Foundation: " . $company->getYearFoundation() . "</h4>";
                         echo  "<h4> City: " . $company->getCity() . "</h4>";
                         echo  "<h4> Description: " . $company->getDescription() . "</h4>";
                         echo  "<h4> Email: " . $company->getEmail() . "</h4>";
                         echo  "<h4> PhoneNumber: " . $company->getPhoneNumber() . "</h4>";
                        ?> 
                         <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" alt="" width="90" height="60">
                         <?php
                    }
               ?>               
          </div>
     </section>
</main>