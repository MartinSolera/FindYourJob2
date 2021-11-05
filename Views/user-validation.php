<?php
require_once('header.php');
?>
<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
        </header>
        <section class ="text-center">
        
            <h3>REGISTRATION:</h3>
            <h4 style="color:royalblue"><p><?php if(isset($message)){ echo $message; }?></p></h4>
            <p>Enter the email that you want to register with</p> 
            
        </section>
        <form action="<?php echo FRONT_ROOT ?>Home/checkRegister" method="POST" class="login-form bg-dark-alpha p-5 text-black">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="email@example.com" required>
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">Check Email</button>

            <center>
                <br>
                <br>
            <a class="btn btn-success btn-xl" href="<?php echo FRONT_ROOT ?>View/Home" > Back to Login</a>
            </center>
        </form>
    </div>
</main>
