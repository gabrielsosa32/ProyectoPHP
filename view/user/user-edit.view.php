<div class="card col-md-10 offset-md-1" style="margin-top: 150px;">
    <div class="card-body" style="padding-top: 55px;">
        <div class="container-fluid text-center">
        <div class="container p-3">
            <h1 class="page-header">
                <?php echo $user->uid != null ? $user->username : 'Nuevo Usuario'; ?>
            </h1>

            <ol class="breadcrumb">
                <li><a href="?c=user">Usuario</a></li>
                <li class="active"><?php echo $user->uid != null ? '&nbsp' . $user->username : '&nbspNuevo Usuario'; ?></li>
            </ol>
        </div>
        <div class="container">
            <form id="frm-user" action="?c=user&a=Save" method="post" enctype="multipart/form-data" class="text-left">
                <input type="hidden" name="uid" value="<?php echo $user->uid; ?>" />
                <div class="form-group">
                    <label>Nombre de usuario</label>
                    <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control" placeholder="Ingrese nombre para su tarea" required>
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control" placeholder="Ingrese nombre para su tarea" required>
                </div>
                <div class="form-group">
                    <label>Escuela:</label>
                    <select name="user_escuela" class="form-control">
                        <option default value="<?php echo $user->user_escuela; ?>"><?php echo $user->user_escuela; ?></option>
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
                    <input type="password" name="password" value="<?php echo $user->password; ?>" class="form-control" placeholder="Ingrese una descripción para su tarea" required>
                </div>
                <div class="form-group">
                    <label>Nivel:</label>
                    <select class="form-control" name="role">
                            <option default value="<?php echo $user->role; ?>"><?php echo $user->role; ?></option>
                            <option value="1">Administrador</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Director</option>
                            <option value="4">Docente</option>
                            <option value="5">Alumno</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado:?></label>
                    <select class="form-control" name="user_status">
                            <option default value="<?php echo $user->user_status; ?>"><?php echo $user->user_status; ?></option>
                            <option value="1">Habilitado</option>
                            <option value="2">Inhabilitado</option>
                    </select>
                </div>

                <hr />

                <div class="text-right">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $("#frm-user").submit(function() {
            return $(this).validate();
        });
    })
</script>

</body>

</html>