<div id="signup">
    <h3>Registro</h3>
    <form method="post" action="" name="signup" class="text-left">
        <div class="form-group">
            <label>Nombre de usuario</label>
            <input type="text" name="usernameReg" autocomplete="off" class="form-control" />
        </div>
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="text" name="emailReg" autocomplete="off" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Escuela:</label>
            <select name="escuelaReg" class="form-control">
                <?php
                    $mysqli = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                    $sqlSelect="SELECT school_nombre FROM schools";
                    $result = $mysqli -> query ($sqlSelect);

                    while ($row = mysqli_fetch_array($result)) {
                        $rows[] = $row;
                    }
                    foreach ($rows as $row) {
                        print "<option value='" . $row['school_nombre'] . "'>" . $row['school_nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="passwordReg" autocomplete="off" class="form-control"/>
        </div>
        <div class="errorMsg">
            <?php echo $errorMsgReg; ?>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" name="signupSubmit" value="Signup">
        </div>
    </form>
</div>