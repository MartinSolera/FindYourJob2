<?php require_once('nav.php'); ?>
<main class="py-5">
     <br>
     <section id="listado" class="mb-9">
               <h2 class="mb-15 text-center" >Students List</h2>
               <br>
               <div class="container" >
               <table class="table bg-light-alpha table-fixed ">
                    <thead class="thead-dark">
                         <th style="width: 200px" scope="col" position="sticky"> File Number </th>
                         <th style="width: 350px" class="" scope="col" position="sticky">Name</th>
                         <th  style="width: 350px"class="header"scope="col" position="sticky">LastName</th>
                         <th style="width: 207px"class="header"scope="col" position="sticky">Info</th>  
                    </thead>
                    
                    <tbody>
                         
                         <?php
                         if (isset($this->studentList)) {
                              foreach($this->studentList as $student) {
                                   echo "<tr style='width: 400px'>";
                                   echo  "<td style='width: 200px'>" . $student->getFileNumber() . "</td>";
                                   echo  "<td style='width: 350px'>" . $student->getFirstName() . "</td>";
                                   echo  "<td style='width: 350px'>" . $student->getLastName() . "</td>";
                                   
                         ?>
                              <td>
                                   <form action=<?php echo FRONT_ROOT."Student/ShowStudent";?> method="POST">
                                        <input type="hidden" name="studentId" value="<?=$student->getStudentId()?>">
                                        <button class="btn btn-dark" type="submit">+</button>
                                   </form>
                              </td>
                         <?php
                              }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>