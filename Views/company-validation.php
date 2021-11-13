<?php
require_once('header.php');
?>
<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
        </header>
        <section class ="text-center">
        
            <h3>Do you represent a company?</h3>
            <h4 style="color:#C70039 "><p><?php if(isset($message)){ echo $message; }?></p></h4>
            <p>Enter the password given by the UTN administration</p> 
            
        </section>
        <form action="<?php echo FRONT_ROOT ?>Home/checkPassword" method="POST" class="login-form bg-dark-alpha p-5 text-black">
            <div class="form-group">
                <label for="">Password</label>
                <input type="Password" name="Password" class="form-control form-control-lg" placeholder="Password" required>
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">Validate</button>

            <center>
                <br>
                <br>
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>View/Home" > Back to Login</a>
            </center>
        </form>
    </div>
</main>
