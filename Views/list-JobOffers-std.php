<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
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
                    <th>Company</th>
                    <th>Job position</th>
                    <th>Career</th>
                    <th>Limit date</th>
                    <th>Status</th>
                    <th>Info</th>  
                    </thead>
                    <tbody>  
                    
                   
                   <?php if(!empty($jobOfferList)){ 
                    foreach($jobOfferList as $jobOffer)
                         if ($jobOffer->getLimitDate() >= date("Y-m-d"))
                         {
                    { ?>
                    <tr>
                        <td><?php echo $jobOffer->getCompany()->getName(); ?></td>
                        <td><?php echo $jobOffer->getJobPosition()->getDescription(); ?></td>
                        <td><?php echo $jobOffer->getJobPosition()->getCareer()->getDescription(); ?></td>
                        <td><?php echo $jobOffer->getLimitDate(); ?></td>
                        <td style="color: red"><?php if($jobOffer->getUserState() == 1){
                                        echo '<b>Active</b>';
                                   } else
                                   echo '<b>Inactive</b>';?>
                         </td>










                        <td>
                              <!-- boton original -->
                            <?php $jobOfferId = $jobOffer->getIdJobOffer();?>
                            <a href="<?php echo FRONT_ROOT."JobOffer/showJobOffer/?jobOfferId=".$jobOfferId;?>" class="btn btn-dark" style="color: white;">+</a>
                              
                            
                              <!-- como lo empezamos a hacer -->
                              <form action="<?php echo FRONT_ROOT."JobOffer/showJobOffer"; ?>" method="post">
                                   <input type="hidden" name="jobOfferId" value="<?= $jobOffer->getIdJobOffer() ?>">
                                   <button class="btn btn-dark" type="submit">+</button>
                              </form>

                              <!-- ejemplos de otro tp -->
                              <form action="<?= ROOT_CLIENT?>Room/addRoom" method="POST">
                                   <input type="hidden" name="idCinema" value="<?= $cinema->getId() ?>">
                                   <button type="submit"><small>Agregar sala</small></button>
                              </form> 

                              <form action="<?php echo ROOT_CLIENT?>cinema" method="POST">
                                   <input type="hidden" name="id" value="<?= $cinema->getId() ?>">
                                   <button class="cinema-delete-btn" type="submit"><small>Eliminar</small></button>
                              </form>      

                         </td>
                         
     
                            <?php }
                         }
                    }?>
                      
                </tbody>
            
               </table>
          </div>
     </section>
</main>
