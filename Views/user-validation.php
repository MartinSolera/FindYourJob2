<?php
require_once('header.php');
?>
<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
        </header>
        <section class ="text-center">
            <h3>REGISTRATION:</h3>
            <p>Enter the email with you want to register</p> 
            
        </section>
        <form action="<?php echo FRONT_ROOT ?>Home/checkRegister" method="POST" class="login-form bg-dark-alpha p-5 text-black">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="email@example.com" required>
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">Check Email</button>
        </form
    </div>
</main>
