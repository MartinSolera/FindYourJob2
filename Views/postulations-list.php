<?php
    require_once('nav.php');
?>
<main class="py-5">
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
                   <form action="" method ="post">
                   <?php 
                       if(!empty($studentsList)){ 
                        foreach($studentsList as $student){ 
                            if($student->getEmail() == $jobOff->getUser->getEmail()){ ?>
                            <tr>
                                <td><?php echo $student->getFileNumber(); ?></td>
                                <td><?php echo $student->getFirstName(); ?></td>
                                <td><?php echo $student->getLastName(); ?></td>
                                <td><?php echo $student->getEmail(); ?></td>
                                <td><button class="btn btn-danger"><a  href="<?php echo FRONT_ROOT."JobOffer/declineStudentApplication?idJobOffer=".$jobOff->getIdJobOffer();?> "style="color: white;">cancel</a><i class="fas fa-edit"></button></td>
                            </tr>
                            }
                        }
                        <?php }
                    ?>
                        </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>