<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Modify Job Offer</h2>
               <form action="<?php echo FRONT_ROOT."JobOffer/modifyJobOffer";?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Company:</label>
                                <?php echo $jobOffer->getCompany()->getName(); ?><br><br>

                                <label for="">Job Position:</label>
                                <?php echo $jobOffer->getJobPosition()->getDescription(); ?><br><br>

                                <label for="">Limit Date</label>
                                <input type="date" name="limitDate" value="<?php echo $jobOffer->getLimitDate(); ?>" required>

                                <label for="">Description</label>
                                <input type="text" name="description" value = "<?php  echo $jobOffer->getDescription();?>" minlength="10" maxlength="1000" required>
                                <!-- <textarea class="input" name="description"  value = " " id="description" cols="30" rows="3" required></textarea> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" name = "idJobOffer" value ="<?php echo $jobOffer->getIdJobOffer();?>" class="btn btn-dark ml-auto d-block">Modify</button>
               </form>
          </div>
     </section>
</main>