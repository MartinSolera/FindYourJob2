<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4> <!-- para mostrar mensaje cuando aplica -->
            <?php
                    if(isset($jobOffer))
                    {
                        echo  "<h4> Company: " . $jobOffer->getCompany()->getName() . "</h4>";
                        echo  "<h4> Job Position: " . $jobOffer->getJobPosition()->getDescription() . "</h4>";
                        echo  "<h4> Limit date for application: " . $jobOffer->getLimitDate() . "</h4>";
                        echo  "<h4> State: " . $jobOffer->getUserState() . "</h4>";

                    }
               ?>               
          </div>
     </section>
</main>