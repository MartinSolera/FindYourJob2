<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Add Job Offer</h2>
               <form action="<?php echo FRONT_ROOT."JobOffer/Add";?>" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="">Description</label>
                                 <input type="text" name="name" placeholder="Name"required >
                                 
                                 <label for="">Datetime</label><br>
                                 <input type="number" name="year" min="0" max="2021" placeholder="initial date for inscriptions" required><br>
                                 
                                 <label for="">Limit Date</label>
                                 <input type="text" name="city" placeholder="limit date for inscriptions" required>
                                 
                                 <label for="">Description</label>
                                 <input type="text" name="description" minlength="10" maxlength="1000" placeholder="Description" required>
                                 
                                 <select class="card-input card-select" name="cinemas" id="cinemas">
                                   
                                 <?php 
                                   foreach($jobPositionList as $jobPosition)
                                   {
                                        echo '<option value="'.$jobPosition->getJobPositionId().'">'. $jobPosition->getDescription().'</option>';
                                   }
                                  ?>
                                  </select> 
                              </div>
                         </div>

                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Add</button>
               </form>
          </div>
     </section>
</main>