<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Add Company</h2>
               <form action="<?php echo FRONT_ROOT."Company/AddCompany";?>" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="">Name</label>
                                 <input type="text" name="name" placeholder="Name"required >
                                 <label for="">Year Foundation</label><br>
                                 <input input type="number" name="year" min="1900" max= "<?php echo date('Y') ?>" step="1" placeholder="Year" required><br>
                                 <label for="city">City</label>
                                 <div class="form-group">
                                   <select name="idcity" id="city" required>
                                   <?php if(isset($listCity)){ foreach($listCity as $city){ ?>
                                   <option value="<?php echo $city->getIdCity();?>" ><?php echo $city->getName();?></option>
                                   <?php } } ?>
                                   </select>
                                   </div>
                                 <label for="">Description</label>
                                 <input type="text" name="description" minlength="10" maxlength="1000" placeholder="Description" required>
                                 <label for="">Email</label>
                                 <input type="email" name="email" placeholder="Email" required>
                                 <label for="">Phone Number</label>
                                 <input type="text" name="phone" placeholder="Phone Number" required>
                                 <label for="">Logo</label>
                                 <input type="file" name ="logo" required> 
                              </div>
                         </div>

                    </div>
                    <button type="submit"  class="btn btn-dark ml-auto d-block">Add</button>
               </form>
          </div>
     </section>
</main>
