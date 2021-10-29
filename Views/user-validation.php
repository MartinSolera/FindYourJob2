<?php
require_once('header.php');
?>
<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
        </header>
        <section class ="text-center">
            <h3>REGISTRATION:</h3>
            <p>Ingrese su e-mail con el cuál se ha registrando en la Univeridad </p> 
            
        </section>
        <form action="<?php echo FRONT_ROOT ?>Home/RegisterValidation" method="POST" class="login-form bg-dark-alpha p-5 text-black">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email requerid" required>
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">Check Mail</button>
        </form>
    </div>
</main>
