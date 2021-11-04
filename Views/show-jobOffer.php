<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        
            <div class="container">
            <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
                <h3 class="mb-3">Job offer</h3><hr>
                <?php
                    if(isset($jobOffer))
                    {
                        echo  "<h4> Company: " . $jobOffer->getCompany()->getName() . "</h4>";
                        echo  "<h4> Job Position: " . $jobOffer->getJobPosition()->getDescription() . "</h4>";
                        echo  "<h4> Limit date for application: " . $jobOffer->getLimitDate() . "</h4>";
                        echo  "<h4> Status: </h4>" ;
                                            if ($jobOffer->getUserState() == 1) {
                                                echo "<h4> active </h4>";
                                            } else {
                                                echo "<h4> inactive </h4>";
                                            }
                    }
               ?>        
             
                <a href="<?php echo FRONT_ROOT."JobOffer/apply/?idJobOffer=".$jobOffer->getIdJobOffer();?>" class="btn btn-dark" style="color: white;">apply</a>
            </div>

    </section>
</main>
