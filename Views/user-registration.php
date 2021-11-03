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
        <form action='<?php echo FRONT_ROOT ?>User/userRegister' method="post" class=" d-flex align-items-center justify-content-center height-100">
            <div class="form-group">
                <div class="form-group">
                    <label for="" align="center"></label>
                    <input type="hidden" name="email" class="form-control form-control-lg" value="<?php echo $student->getEmail()?>" required>
                    <input type="password" alt="strongPass" name="password" class="form-control form-control-lg" placeholder="Password required" required>
                    <label for="" align="center">Password</label>
                    
                    <input type="password" alt="strongPass" name="confirmPass" class="form-control form-control-lg" placeholder="Password required" required>
                    <label for="" align="center">Confirm Password</label>
                    <br><br>
                    <button class="btn btn-dark btn-block btn-m " type="submit">Registration</button>
                </div>
            </div>
        </form>
    </section>
</main>