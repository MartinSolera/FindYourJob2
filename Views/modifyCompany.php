<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Modify Company</h2>
               <form action="<?php echo FRONT_ROOT."Company/ModifyCompany";?>" method="POST" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="">Name</label>
                                 <input type="text" name="name" value = "<?php  echo $company->getName();?>" required>
                                 <label for="">Year Foundation</label><br>
                                 <input type="number" name="yearFoundation"  value ="<?php echo $company->getYearFoundation();?>" min="1900" max="2099"  required><br>
                                 <label for="city">City</label>
                                 <div class="form-group">
                                   <select name="idCity" id="city" required>
                                        
                                   <?php if(isset($listCity)){ foreach($listCity as $city){ ?>
                                   <option value="<?php echo $city->getIdCity();?>"><?php echo $city->getName();?></option>
                                   <?php } } ?>
                                   </select>
                                   </div>
                                 <label for="">Description</label>
                                 <input type="text" name="description" value = "<?php  echo $company->getDescription();?>" minlength="10" maxlength="1000" required>
                                 <label for="">Email</label>
                                 <input type="email" name="email"  value = "<?php  echo $company->getEmail();?>" required>
                                 <label for="">Phone Number</label>
                                 <input type="text" name="phoneNumber" value = "<?php  echo $company->getPhoneNumber();?>" required><br>
                                 <label for="">Photo</label><br>
                                 <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" alt="" width="60" height="30">
                                 <input type="file" name ="logo" value ="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>"> 
                              </div>
                         </div>
                    </div>
                    <button type="submit" name = "idCompany" value ="<?php echo $company->getIdCompany();?>" class="btn btn-dark ml-auto d-block">Modify</button>
               </form>
          </div>
     </section>
</main>
