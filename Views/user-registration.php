<?php

?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h3>Ingrese sus datos:</h3>
            <h4 style="color: rgb(145, 39, 177)">
            <?php
                if (isset($invalidEmail)) {
                    echo "Error: el email no corresponde a un estudiante activo.";
                }
                if (isset($registedEmail)) {
                    echo "Error: el email ya se encuentra en el sistema.";
                }
            ?>
            </h4>
        </header>

        <form action="<?php echo FRONT_ROOT ?>User/Register" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <div class="form-group">
                <label for="">password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar contraseña" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Registrarse</button>
        </form>
    </div>
</main>
