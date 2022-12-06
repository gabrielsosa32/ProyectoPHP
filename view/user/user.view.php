<div class="card col-md-10 offset-md-1" style="margin-top: 150px;">
    <div class="card-body" style="padding-top: 55px;">
        <div class="container-fluid text-center">
        <h1 class="page-header text-center p-3">Administración de Usuarios</h1>  
        
        <form action="" method="post">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <div class="container p-3">
                    <a class="btn btn-primary pull-right" href="?c=user&a=Edit">Agregar nuevo alumno</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input class="form-control" type="text" name="valueToSearch" placeholder="Buscar un usuario">
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
                            <th class="custom-table-1" style="width:180px;">Usuario</th>
                            <th class="custom-table-1" style="width:120px;">Email</th>
                            <th class="custom-table-1" style="width:120px;">Escuela</th>
                            <th class="custom-table-1" style="width:120px;">Nivel</th>
                            <th class="custom-table-1" style="width:120px;">Estado</th>          
                            <th class="custom-table-1" style="width:60px;"></th>
                            <th class="custom-table-1" style="width:60px;"></th>
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
                    <?php foreach($this->model->SearchAndListAllUsers($valueToSearch) as $r): ?>
                        <tr>
                            <td><?php echo $r->username; ?></td>
                            <td><?php echo $r->email; ?></td>
                            <td><?php echo $r->user_escuela; ?></td>
                            <td><?php echo $r->role; ?></td>
                            <td><?php echo $r->user_status; ?></td>
                            <td>
                                <a  class="btn btn-warning" href="?c=user&a=Edit&uid=<?php echo $r->uid; ?>">Ver</a>
                            </td>
                            <td>
                                <a  class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=user&a=Delete&uid=<?php echo $r->uid; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

</body>
</html>