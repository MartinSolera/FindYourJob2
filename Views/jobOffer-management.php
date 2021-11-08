<?php
    require_once('nav.php');
?>
<main class="py-5">
<script src="https://kit.fontawesome.com/4fa39b8df5.js" crossorigin="anonymous"></script>
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
               <h2 class="mb-4">Job Offer Management</h2>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>Company</th>
                    <th>Job position</th>
                    <th>Description</th>
                    <th>Limit date</th>
                    <th>Status</th>
                    <th>Modify</th>  
                    <th>Delete</th> 
                    <th>Applications</th>
                    </thead>
                    <tbody>  
                   <form action="" method ="post">
                   <?php if(!empty($jobOfferList)){ 
                  foreach($jobOfferList as $jobOff){ ?>
                    <tr>
                         <td><?php echo $jobOff->getCompany()->getName(); ?></td>
                         <td><?php echo $jobOff->getJobPosition()->getDescription(); ?></td>
                         <td><?php echo $jobOff->getDescription(); ?></td>
                         <td><?php echo $jobOff->getLimitDate(); ?></td>
                         <td><?php  if($jobOff->getUserState() == 1){
                                        echo 'active';
                                   } else
                                   echo 'inactive';?></td>
                         <td><button class="btn btn-danger"><a  href="<?php echo FRONT_ROOT."JobOffer/JobOfferModifyView?idJobOffer=".$jobOff->getIdJobOffer();?> "style="color: white;">modify </a><i class="fas fa-edit"></button></td> 
                         
                         <td><button class="btn btn-danger"><a href="<?php if(isset($jobOff)){echo FRONT_ROOT . "JobOffer/deleteJobOffer?idJobOffer=".$jobOff->getIdJobOffer();}?> "  style="color: white;">delete </a><i class="fas fa-trash-alt"></i></button></td>
                    
                         <td><button class="btn btn-danger"><a  href="<?php echo FRONT_ROOT."JobOffer/applicantsList?idJobOffer=".$jobOff->getIdJobOffer();?> "style="color: white;">applicants </a></button></td> 
                    </tr>
                             <?php }
                    }?>
                        </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>