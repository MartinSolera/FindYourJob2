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
                    <th>Logo</th>  
                    <th> 
                         <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin" style="color:black;" >  Name </a> 
                         <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewCompanyAsc">  <i class="fas fa-sort-alpha-down"></i> </a> 
                         <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewCompanyDesc"> <i class="fas fa-sort-alpha-down-alt"></i></a> 
                    </th>
                         
                    <th>Foundation Year</th>
                    <th>City</th>
                    <th>Description</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Modify</th> 
                    <th>Delete</th>
                    </thead>
                    <tbody>  
                   <form action="" method ="post">
                   <?php if(!empty($companies)){ 
                  foreach($companies as $company){ ?>
                      <tr>
                        <td> <img src="<?php if(!empty($company->getLogo())) echo IMG_PATH.$company->getLogo();?>" alt="" width="60" height="30"></td>
                        <td><?php echo $company->getName(); ?></td>
                        <td><?php echo $company->getYearFoundation(); ?></td>
                        <td><?php echo $company->getCity()->getName(); ?></td>
                        <td><?php echo $company->getDescription(); ?></td>
                        <td><?php echo $company->getEmail(); ?></td>
                        <td><?php echo $company->getPhoneNumber(); ?></td>
                          
                        <td> 
                             <form action=<?php echo FRONT_ROOT."Company/ShowModifyCompany";?> method="POST">
                              <input type="hidden" name="idCompany" value="<?=$company->getIdCompany()?>">
                              <button class="btn btn-danger ml-auto d-block" type="submit" style="color: white;">Modify<i class="fas fa-edit"></i></button>
                              </form>
                         </td>      

                        <td> 
                             <form action=<?php if(isset($company)){echo FRONT_ROOT . "Company/DeleteCompany";?> method="POST">
                              <input type="hidden" name="idCompany" value="<?=$company->getIdCompany()?>">
                              <button class="btn btn-danger ml-auto d-block" type="submit" style="color: white;">Delete<i class="fas fa-trash-alt"></i></button>
                              </form>
                         </td>      
                      </tr>
                             <?php }
                         }
                         }?>
                        
                      </form>
                        
                    </tbody>
               </table>
          </div>
     </section>
</main>


