<?php require_once('nav.php'); ?>
<main class="py-5">
     <br>
     <section id="listado" class="mb-9">
          
               
               <h2 class="mb-15 text-center" >Students List</h2>
               <br>
               <div class="container" style="width: 2000px; height: 400px; overflow-y: scroll;">
               <table class="table bg-light-alpha">
                    <thead class="thead-dark">
                         <th class="header" scope="col" position="sticky">Name</th>
                         <th class="header" scope="col" position="sticky">SurName</th>
                         <th class="header" scope="col" position="sticky">ID</th>
                         <th class="header" scope="col" position="sticky">Carrer</th>
                       <!--  <th class="header" scope="col" position="sticky">Ver</th> -->
                         
                    </thead>
                    
                    
                    <tbody>
                         
                         <?php
                         if (isset($this->studentList)) {
                              foreach($this->studentList as $student) {
                                   echo "<tr>";
                                   echo  "<td>" . $student->getFirstName() . "</td>";
                                   echo  "<td>" . $student->getLastName() . "</td>";
                                   echo  "<td>" . $student->getFileNumber() . "</td>";
                                   if (isset($careers)) {
                                        foreach ($careers as $career) {
                                             if ($career->getCareerId() == $student->getCareerId()) {
                                                  echo  "<td>" . $career->getDescription()  . "</td>";
                                                  $careerName = $career->getDescription();
                                             }
                                        }
                                   }
                                   $studentId = $student->getstudentId();
                                   //$careerName = $career->getDescription();

                                   echo "<td><a href=" . FRONT_ROOT . "Student/ShowStudent/" . $studentId . ">+ info</a></td>";
                                   echo "</tr>";
                              }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>