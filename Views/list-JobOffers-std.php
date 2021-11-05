<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Job Offers</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/filterJobOffersForJobPosition" method="POST" enctype="multipart/form-data">
                    <div id="outer">
                         <input type="text" name="search" class="" placeholder="Job position name"  required>
                         <button type="submit"  class="btn btn-dark " >Search</button>
                         <button type="submit"  class="btn btn-dark " > <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferList" style="color: white;">Clean</a></button>
                    </div>
                    <br>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>Company Name</th>
                    <th>Job position</th>
                    <th>Career</th>
                    <th>Limit date</th>
                    <th>Status</th>
                    <th>Info</th>  
                    </thead>
                    <tbody>  
                    
                   
                   <?php if(!empty($jobOfferList)){ 
                    foreach($jobOfferList as $jobOffer){ ?>
                    <tr>
                        <td><?php echo $jobOffer->getCompany()->getName(); ?></td>
                        <td><?php echo $jobOffer->getJobPosition()->getDescription(); ?></td>
                        <td><?php echo $jobOffer->getJobPosition()->getCareer()->getDescription(); ?></td>
                        <td><?php echo $jobOffer->getLimitDate(); ?></td>
                        <td><?php if($jobOffer->getUserState() == 1){
                                        echo 'active';
                                   } else
                                   echo 'inactive';?></td>
                        
                        <td>
                            <?php $jobOfferId = $jobOffer->getIdJobOffer();?>
                            <a href="<?php echo FRONT_ROOT."JobOffer/ShowJobOffer/?jobOfferId=".$jobOfferId;?>" class="btn btn-dark" style="color: white;">+</a>
                        </td>
     
                            <?php }
                          }?>
                      
                </tbody>
            
               </table>
          </div>
     </section>
</main>
