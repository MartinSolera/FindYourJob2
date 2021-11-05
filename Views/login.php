<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h1>Find Your Job </h1>
               <h4 style="color: #C70039"><p><?php if(isset($message)){ echo $message; }?></p></h4>
          </header>
          <form action=<?php echo FRONT_ROOT.'Home/login'?> method="post" class="login-form bg-dark-alpha p-5 text-black">
               <div class="form-group">
                    <label for="">EMAIL</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Type email required" required>
               </div>
               <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Type password required" required>
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit" >Log In</button>
               
               <a class="btn btn-dark btn-block btn-lg" href="<?php echo FRONT_ROOT ?>Home/ShowRegister">Registration</a>
            </form>
     </div>
</main>

     