<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
            <div class="container">
                <div class="bg-light-alpha p-5">
                    <h3 class="mb-3">Job offer</h3><hr>
                    <?php
                        if(isset($jobOffer))
                        {
                            echo  "<h5><b> Company: " . $jobOffer->getCompany()->getName() . "</b></h5>";
                            echo  "<h5><b> Job Position: </b>" . $jobOffer->getJobPosition()->getDescription() . "</h5>";
                            echo  "<h5><b> Limit date for application: </b>" . $jobOffer->getLimitDate() . "</h5>";
                            //echo  "<h5><b> Status:</b> </h5> " ;
                                                if ($jobOffer->getUserState() == 1) {
                                                    echo "<h4><b> Active </h4>";
                                                } else {
                                                    echo "<h4><b> inactive </h4>";
                                                }
                        }
                    ?>        
                    <br>

                    <div id="outer">
                         <button type="submit"  class="btn btn-dark ml-auto d-block " ><a href="<?php echo FRONT_ROOT."JobOffer/apply/?idJobOffer=".$jobOffer->getIdJobOffer();?>" class="btn btn-dark" style="color: white;">Apply</a></button>
                        <br>
                         <button type="submit"  class="btn btn-danger ml-auto d-block" > <a href="<?php echo FRONT_ROOT."JobOffer/cancelApplication/?idJobOffer=".$jobOffer->getIdJobOffer();?>" class="btn btn-danger" style="color: white;">Cancel application</a></button>
                         
                    </div>
                    
                    
                    
                </div>
            </div>

    </section>
</main>
