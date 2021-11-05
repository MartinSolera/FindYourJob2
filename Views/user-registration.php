<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
        
            <h2 class="mb-4">Profile</h2>
            
            <table class="table bg-light-alpha">
                <thead>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>email</th>
                </thead>
                <tbody>

                    <?php
                    if (isset($student)) {
                        echo  "<td>" . $student->getFirstName() . "</td>";
                        echo  "<td>" . $student->getLastName() . "</td>";
                        echo  "<td>" . $student->getEmail() . "</td>";

                    }
                    ?>
                </tbody>
                </table>
        </div>
    </section>
    <section>
        <form action='<?php echo FRONT_ROOT ?>User/userRegister' method="POST" class=" d-flex align-items-center justify-content-center height-100">
            <div class="form-group">
                <div class="form-group">
                    <label for="" align="center"></label>
                    
                    <input type="hidden" name="email" class="form-control form-control-lg" value="<?php echo $student->getEmail()?>" required>

                    <input type="password" alt="strongPass" name="password" class="form-control form-control-lg" placeholder="Password required" minlength="5" maxlength="25" required>
                    <label for="" align="center">Password</label>
                    
                    <input type="password" alt="strongPass" name="confirmPass" class="form-control form-control-lg" placeholder="Confirm password" minlength="5" maxlength="25"required>
                   
                    <label for="" align="center">Confirm Password</label>

                    <input type="email"  name="personalEmail" class="form-control form-control-lg" placeholder="Type your personal email" minlength="2" maxlength="65">
                   
                   <label for="" align="center">OPTIONAL ! Email to recive</label>
                    
                    <br><br>
                    <button class="btn btn-dark btn-block btn-m " type="submit">Registration</button>
                    <center> 
                    <br>
                    <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>Home/Home" > Back to Login</a>
                    <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>Home/ShowRegister" > Back to Registration Menu</a>
                    </center>
                </div>
            </div>
        </form>
    </section>
</main>