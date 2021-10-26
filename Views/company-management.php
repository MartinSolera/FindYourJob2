<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Company Management !</h2>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>Name</th>
                    <th>Foundation Year</th>
                    <th>City</th>
                    <th>Description</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Logo</th>  
                    <th>Modify</th> 
                    </thead>
                    <tbody>  
                   <form action="" method ="get">
                   <?php if(!empty($companies)){ 
                  foreach($companies as $company){ ?>
                      <tr>
                        <td><?php echo $company->getName(); ?></td>
                        <td><?php echo $company->getYearFoundation(); ?></td>
                        <td><?php echo $company->getCity()->getName(); ?></td>
                        <td><?php echo $company->getDescription(); ?></td>
                        <td><?php echo $company->getEmail(); ?></td>
                        <td><?php echo $company->getPhoneNumber(); ?></td>
                        <td> <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" alt="" width="60" height="30"></td> 
                        <td><button class="btn btn-danger" ><a href="<?php echo FRONT_ROOT."Company/ShowModifyCompany?nameCompany=".$company->getName()."&email=".$company->getEmail();?> " style="color: white;">modify</a></button></td> 
                        <td><button class="btn btn-danger">
                                   <a href="<?php if(isset($company)){echo FRONT_ROOT . "Company/DeleteCompany/" . $company->getEmail();}; ?>">Eliminar Empresa</a>
                         </td>      
                      </tr>
                             <?php }
                          }?>
                        
                      </form>
                        

                    </tbody>
               </table>
          </div>
     </section>
</main>

<main class="py-5">  
<div class="container">
<h3 class="mb-4">Remove Company</h3>
        <form action="<?php echo FRONT_ROOT."Company/DeleteCompany" ?>" method="post">
        <table  style="max-width: 35%;">
            <thead>
              <tr>
                <th style="width: 100px;">Email</th>
              </tr>
            </thead>
            <tbody align=center>
              <tr>
                <td>
                    <input type="email" name="email" style="height: 40px;" placeholder="company email" required>
                </td>

                <td>
                  <button type="submit" class="btn" value="">Delete</button>
                </td>
              </tr>
            </tbody>
            </tr>
          </table>
         </form>
      </div>
</main>


