<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Add Job Offer</h2>
               <form action="<?php echo FRONT_ROOT."JobOffer/AddJobOffer";?>" method="post" class="bg-light-alpha p-5">
                                   <h4 >
                                        <?php
                                        if (isset($invalidDate)) {
                                             echo "La fecha limite no puede ser menor a la actual";
                                        }                                  
                                        ?>
                                   </h4>
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="company">Company</label>
                                   <div class="form-group">
                                        <select name="idCompany" id="company" required>
                                             <?php if(isset($companyList)){ foreach($companyList as $company){ ?>
                                             <option value="<?php echo $company->getIdCompany(); ?>"><?php echo $company->getName();?></option>
                                             <?php } } ?>
                                        </select>
                                   </div>

                                   <label for="jobPosition">Job Position</label>
                                   <div class="form-group">
                                        <select name="idJobPosition" id="jobPosition" required>
                                             <?php if(isset($jobPositionList)){ foreach($jobPositionList as $jobP){ ?>
                                             <option value="<?php echo $jobP->getId(); ?>"><?php echo $jobP->getDescription();?></option>
                                             <?php } } ?>
                                        </select>
                                   </div>
                                   
                                 <label for="">Datetime</label>
                                 <input type="date" name="datetime" value="<?php echo date('d-m-y')?>"  placeholder="initial date for inscriptions" required>
                                 
                                 <label for="">Limit Date</label>
                                 <input type="date" name="limitdate" placeholder="limit date for inscriptions" required>
                                 
                                 <label for="">Description</label>
                                 <!-- <input type="text" name="description" minlength="10" maxlength="1000" placeholder="Description" required> -->
                                 <textarea class="input" name="description" id="description" cols="30" rows="3" placeholder="Description of the offer..." required></textarea>


                              </div>
                         </div>

                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Add</button>
               </form>
          </div>
     </section>
</main>