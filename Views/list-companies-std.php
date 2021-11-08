<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Companies List</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/FilterCompanies" method="POST" enctype="multipart/form-data">
                    <div id="outer">
                         <input type="text" name="search" class="" placeholder="Company Name"  required>
                         <button type="submit"  class="btn btn-dark " >Search</button>
                         <button type="submit"  class="btn btn-dark " > <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewStudent" style="color: white;">Clean</a></button>
                    </div>
                    <br>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>Company Name</th>

                    <th>City</th>

                    <th>Info</th>  
                    </thead>
                    <tbody>  
                    
                   <form action=<?php echo FRONT_ROOT.'Company/ShowListViewStudent'?> method ="POST">  
                   <?php if(!empty($companies)){ 
                    foreach($companies as $company){ ?>
                    
                    <tr>
                         <td><?php echo $company->getName(); ?></td>

                         <td><?php echo $company->getCity()->getName(); ?></td>
                         
                         <td>
                              <form action=<?php echo FRONT_ROOT."Company/ShowCompany";?> method="POST">
                                   <input type="hidden" name="idCompany" value="<?=$company->getIdCompany()?>">
                                   <button class="btn btn-dark" type="submit">+</button>
                              </form>
                         </td>
     
                             <?php }
                          }?>
                          </form>    
                    </tbody>
            
               </table>
          
     </section>
</main>
