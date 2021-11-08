<?php
    require_once('nav.php');
?>
<main class="py-5">
<script src="https://kit.fontawesome.com/4fa39b8df5.js" crossorigin="anonymous"></script>
     <section id="listado" class="mb-5">
          <div class="container">
           <h2 class="mb-4">Postulations</h2>
               <table class="table bg-light-alpha">
                    <thead>
                    <th>File number</th>
                    <th>Name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Decline application</th>
                    </thead>
                    <tbody>  
                   
                   <?php 
                       if(!empty($studentsList)){ 
                        foreach($studentsList as $student){ 
                            if($student->getEmail() == $jobOff->getUser()->getEmail()){ ?>
                            <tr>
                                <td><?php echo $student->getFileNumber(); ?></td>
                                <td><?php echo $student->getFirstName(); ?></td>
                                <td><?php echo $student->getLastName(); ?></td>
                                <td><?php echo $student->getEmail(); ?></td>
                                <td><button class="btn btn-danger"><a  href="<?php echo FRONT_ROOT."JobOffer/declineStudentApplication?idStudent=".$jobOff->getUser()->getId();?> "style="color: white;">decline  </a><i class="fas fa-user-times"></i></button></td>
                            </tr>
                            <?php 
                            }
                        }
                        }
                    ?>  
                    </tbody>
               </table>
          </div>
     </section>
</main>