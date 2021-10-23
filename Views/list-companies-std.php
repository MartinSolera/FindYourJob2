<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Companies List</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/FilterCompanies" method="POST" enctype="multipart/form-data">
                    <input type="text" name="search" class="form-control form-control-ml" placeholder="Company Name"  required>
                    <br>
                    <button type="submit"  class="btn btn-dark ml-auto d-block" >Search</button>
                    <br>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>Company Name</th>

                    <th>City</th>

                    <th>Info</th>  
                    </thead>
                    <tbody>  
                    
                   <form action=<?php echo FRONT_ROOT.'Company/ShowListViewStudent'?> method ="get">  
                   <?php if(!empty($companies)){ 
                    foreach($companies as $company){ ?>
                    
                    <tr>
                         <td><?php echo $company->getName(); ?></td>

                         <td><?php echo $company->getCity()->getName(); ?></td>

                         <td>
                              <a href="<?php echo FRONT_ROOT."Company/ShowCompany/?nameCompany=".$company->getName()."&email=".$company->getEmail();?>" class="btn btn-dark" style="color: white;">+</a>
                         </td>
     
                             <?php }
                          }?>
                          </form>    
                    </tbody>
            </form>
               </table>
          </div>
     </section>
</main>
