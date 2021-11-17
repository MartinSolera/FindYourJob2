<main class="py-5">
    <section>
        <form action='<?php echo FRONT_ROOT ?>User/userCompanyRegister' method="POST" class=" d-flex align-items-center justify-content-center height-100">
            <div class="form-group">
                <div class="form-group">
                    <label for="" align="center">Company email</label>
                    
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email required"required><br>

                    <label for="" align="center">Password</label>
                    <input type="password" alt="strongPass" name="password" class="form-control form-control-lg" placeholder="Password required" minlength="5" maxlength="25" required><br>
                    
                    <label for="" align="center">Confirm Password</label>

                    <input type="password" alt="strongPass" name="confirmPass" class="form-control form-control-lg" placeholder="Confirm password" minlength="5" maxlength="25"required>
                   
                    <br><br>
                    <button class="btn btn-dark btn-block btn-m " type="submit">Registration</button>
                    <center> 
                    <br>
                    <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>View/Home" > Back to Login</a>
                    <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>Home/ShowRegister" > Back to Registration Menu</a>
                    </center>
                </div>
            </div>
        </form>
    </section>
</main>