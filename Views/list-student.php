<?php require_once('nav.php'); ?>
<main class="py-5">
     <br>
     <section id="listado" class="mb-9">
          
               
               <h2 class="mb-15 text-center" >Students List</h2>
               <br>
               <div class="container" >
               <table class="table bg-light-alpha table-fixed ">
                    <thead class="thead-dark">
                         <th style="width: 200px" class="" scope="col" position="sticky">Name</th>
                         <th  style="width: 230px"class="header"scope="col" position="sticky">LastName</th>
                         <th style="width: 150px" scope="col" position="sticky">ID</th>
                    </thead>
                    
                    <tbody>
                         
                         <?php
                         if (isset($students)) {
                              foreach($students as $student) {
                                   echo "<tr style='width: 400px'>";
                                   echo  "<td style='width: 200px'>" . $student->getFirstName() . "</td>";
                                   echo  "<td style='width: 200px'>" . $student->getLastName() . "</td>";
                                   echo  "<td style='width: 200px'>" . $student->getFileNumber() . "</td>";
                              }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>