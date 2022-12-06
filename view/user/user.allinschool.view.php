<div class="card col-md-10 offset-md-1" style="margin-top: 150px;">
    <div class="card-body" style="padding-top: 55px;">
        <div class="container-fluid text-center">
        <h1 class="page-header text-center p-3">Listado de integrantes de la escuela <?php echo $userDetails->user_escuela ?></h1>

            <form action="" method="post">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div class="container p-3">
                    </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <input class="form-control" type="text" name="valueToSearch" placeholder="Buscar un alumno">
                </div>
                <div class="form-group">
                    <input class="btn" type="submit" name="search" value="Buscar">
                </div>
                </div>
            </div>

                <div class="table-responsive container">
                    <table class="table table-striped  table-hover" id="tabla">
                        <thead>
                            <tr>
                                <th class="custom-table-1" style="width:180px;">Nombre de Usuario</th>
                                <th class="custom-table-1" style="width:120px;">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if (isset($_POST['search']))
                        {
                            $valueToSearch = $_POST['valueToSearch']; 
                        }
                        else
                        {
                            $valueToSearch = "";
                        }
                        
                        ?>
                        <?php foreach($this->model->ListAllUserInSchool($userDetails->user_escuela, $valueToSearch) as $r): ?>
                            <tr>
                                <td><?php echo $r->username; ?></td>
                                <td><?php echo $r->email; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table> 
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>