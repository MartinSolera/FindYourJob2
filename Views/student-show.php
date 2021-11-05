<?php
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="conteiner">
               <div class="bg-light-alpha p-5">
                         <?php
                         if (isset($student)) {
                              echo  "<h3><b>" . $student->getFirstName() . " " . $student->getLastName() . "</b></h3> <br>";
                              echo  "<h5> <b>DNI: </b>" . $student->getDni() . "</h5> <br>";
                              echo  "<h5> <b>Gender: </b>" . $student->getGender() . "</h5> <br>";
                              echo  "<h5> <b>Birth Date: </b>" . $student->getBirthDate() . "</h5> <br>";
                              echo  "<h5> <b>File Number: </b>" . $student->getFileNumber() . "</h5> <br>";
                              echo  "<h5> <b>Email: </b>" . $student->getEmail() . "</h5> <br>";
                              echo  "<h5> <b>Phone Number: </b>" . $student->getPhoneNumber() . "</h5> <br>";
                         }
                         ?>
                         <a href="<?php echo FRONT_ROOT ?>Student/ShowStudentList" class="btn btn-dark btn-lg btn-block" style="margin-top: 5vh;">Students List</a>

               </div>

          </div>
     </section>
</main>