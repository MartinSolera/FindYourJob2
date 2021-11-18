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
                       if(!empty($userStudentList)){ 
                        foreach($userStudentList as $userS){ 
                            foreach($studentsList as $student){ 
                                foreach($postulationsList as $idStudentP){
                                    if($userS->getId() == $idStudentP){
                                        if($student->getEmail() == $userS->getEmail()){ ?>
                                        <tr>
                                            <td><?php echo $student->getFileNumber(); ?></td>
                                            <td><?php echo $student->getFirstName(); ?></td>
                                            <td><?php echo $student->getLastName(); ?></td>
                                            <td><?php echo $student->getEmail(); ?></td>
                                            <td>
                                                <form action=<?php echo FRONT_ROOT."JobOffer/declineApplication";?> method="POST">
                                                    <input type="hidden" name="idStudent" value="<?=$userS->getId()?>" />
                                                    <input type="hidden" name="idJobOffer" value="<?=$idJobOffer?>"/>
                                                    <button class="btn btn-danger d-block" type="submit" style="color:black; margin-left:65px;" > <b> X </b></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                    }
                                }
                            }
                        }
                        }
                    ?>  
                    </tbody>
               </table>
          </div>
     </section>
     </section>
      <form action=<?php echo FRONT_ROOT."JobOffer/SendPdfListEstudient";?> method="POST">
        <input type="hidden" name="idJobOffer" value="<?=$idJobOffer?>"/>
        <button class="btn btn-danger d-block" type="submit" style="color:black; margin-left:65px;"><b>Generate PDF</b></button>
      </form>
     <section> 
</main>