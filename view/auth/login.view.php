<div id="login">
    <h3>Login</h3>
    <form method="post" action="" name="login" class=" text-left">
        <div class="form-group">
            <label>Nombre de usuario o Correo Electrónico</label>
            <input type="text" name="usernameEmail" autocomplete="off" class="form-control"/>
        </div>    
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" autocomplete="off" class="form-control"/>
        </div>
    <div class="errorMsg">
        <?php echo $errorMsgLogin; ?>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" name="loginSubmit" value="Login">
    </div>
    </form>
</div>