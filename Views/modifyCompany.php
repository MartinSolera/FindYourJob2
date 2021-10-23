<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Modify Company</h2>
               <form action="<?php echo FRONT_ROOT."Company/ModifyCompany";?>" method="get" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="">Name</label>
                                 <input type="text" name="name" value = "<?php  echo $company->getName();?>" required>
                                 <label for="">Year Foundation</label>
                                 <input type="number" name="year_foundation" value = "<?php  echo $company->getYearFoundation();?>" min="0" required>
                                 <label for="">City</label>
                                 <input type="text" name="city" value = "<?php  echo $company->getCity();?>" required>
                                 <label for="">Description</label>
                                 <input type="text" name="description" value = "<?php  echo $company->getDescription();?>" minlength="10" maxlength="1000" required>
                                 <label for="">Email</label>
                                 <input type="email" name="email"  value = "<?php  echo $company->getEmail();?>" required>
                                 <label for="">Phone Number</label>
                                 <input type="text" name="phone_number" value = "<?php  echo $company->getPhoneNumber();?>"  required>
                                 <label for="">Photo</label>
                                 <input type="file" name ="logo" value ="<?php/* echo IMGCOOL_PATH.$product->getPhoto();*/?>"> 
                              </div>
                         </div>

                    </div>
                    <input id="name" name="nameCompany " type="hidden" value="<?php echo $company->getName();?>">
                    <button type="submit" name = "emailCompany" value ="<?php echo $company->getEmail();?>"  class="btn btn-dark ml-auto d-block">Modify</button>
               </form>
          </div>
     </section>
</main>
