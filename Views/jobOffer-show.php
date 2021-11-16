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
                        }
                    ?>        
                    <br><?php if(!empty($jobOffer->getFlyer())){?>
                    <br>
                        <img src="<?php echo IMG_PATH.$jobOffer->getFlyer();?>" width="400" height="250"><br>
                    <br><?php }?>
                    
                    <div id="outer">
                        <form action=<?php echo FRONT_ROOT."JobOffer/apply";?> method="POST">
                            <input type="hidden" name="idJobOffer" value="<?=$jobOffer->getIdJobOffer()?>">
                            <button class="btn btn-dark ml-auto d-block " type="submit">Apply</button>
                        </form>

                        <br>
                         <form action=<?php echo FRONT_ROOT."JobOffer/cancelApplication";?> method="POST">
                            <input type="hidden" name="idJobOffer" value="<?=$jobOffer->getIdJobOffer()?>">
                            <button class="btn btn-danger ml-auto d-block" type="submit">Cancel application</button>
                        </form>
                    </div>
                    
                    
                    
                </div>
            </div>

    </section>
</main>
