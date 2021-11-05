<?php
    require_once('nav.php');
?>
<main class="py-5">
<script src="https://kit.fontawesome.com/4fa39b8df5.js" crossorigin="anonymous"></script>
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Company Management</h2>
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
                    <th>Delete</th>
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
                        <td><button class="btn btn-danger" ><a href="<?php echo FRONT_ROOT."Company/ShowModifyCompany?idCompany=".$company->getIdCompany();?> " style="color: white;">Modify </a><i class="fas fa-edit"></i> </button></td> 
                        
                        <td><button class="btn btn-danger"><a href="<?php if(isset($company)){echo FRONT_ROOT . "Company/DeleteCompany?idCompany=".$company->getIdCompany();}?> " style="color: white;"> Delete </a><i class="fas fa-trash-alt"></i></button></td>      
                      </tr>
                             <?php }
                          }?>
                        
                      </form>
                        

                    </tbody>
               </table>
          </div>
     </section>
</main>


