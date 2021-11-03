<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Modify Job Offer</h2>
               <form action="<?php echo FRONT_ROOT."JobOffer/Modify";?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="company">Company</label>
                            <?php echo $jobPosition->getCompany()->getName(); ?>
                                <label for="">Limit Date</label>
                                <input type="date" name="limitdate" placeholder="limit date for inscriptions" required>

                                <label for="">Description</label>
                                <textarea class="input" name="description" id="description" cols="30" rows="3" placeholder="Description of the offer..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name = "idJobOffer" value ="<?php echo $jobPosition->getId();?>" class="btn btn-dark ml-auto d-block">Modify</button>
               </form>
          </div>
     </section>
</main>
