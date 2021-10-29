<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Profile</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>DNI</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Id</th>
                    <th>Career</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </thead>
                <tbody>

                    <?php
                    if (isset($student)) {
                        echo  "<td>" . $student->getFirstName() . "</td>";
                        echo  "<td>" . $student->getLastName() . "</td>";
                        echo  "<td>" . $student->getDni() . "</td>";
                        echo  "<td>" . $student->getGender() . "</td>";
                        echo  "<td>" . $student->getBirthDate() . "</td>";
                        echo  "<td>" . $student->getFileNumber() . "</td>";
                        echo  "<td>" . $student->getCareerId() . "</td>";
                        echo  "<td>" . $student->getEmail() . "</td>";
                        echo  "<td>" . $student->getPhoneNumber() . "</tdv>";
                    }
                    ?>
                </tbody>
                </table>
        </div>
    </section>
    <section>
        <form action='<?php echo FRONT_ROOT ?>Student/studentRegistration' method="post" class="bg-light-alpha p-5">
            <div>
                <div class="form-group">
                    <label for="" align="center"></label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="<?php echo $student->getEmail()?>" required>
                    <label for="" align="center">Password</label>
                    <input type="password" alt="strongPass" name="password" class="form-control form-control-lg" placeholder="User required" required>
                    <label for="" align="center">Confirm Password</label>
                    <input type="password" alt="strongPass" name="confirmPass" class="form-control form-control-lg" placeholder="Password required" required>

                    <center>
                        <button class="btn btn-warning btn-block btn-sm " type="submit">Registration</button>
                    </center>

                </div>

            </div>
        </form>
    </section>
</main>