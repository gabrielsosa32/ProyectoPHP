<h1 class="page-header text-center p-3">Gestionador de tareas</h1>


<form action="" method="post">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-4">
        <div class="container p-3">
            <a class="btn btn-primary pull-right" href="?c=task&a=Edit">Agregar nueva tarea</a>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control" type="text" name="valueToSearch" placeholder="Buscar una tarea mediante cualquier valor">
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
                    <th class="custom-table-1" style="width:180px;">Nombre</th>
                    <th class="custom-table-1" style="width:120px;">Etiqueta</th>
                    <th class="custom-table-1" style="width:120px;">Fecha</th>
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
            <?php foreach($this->model->SearchAndList($userDetails->uid, $valueToSearch) as $r): ?>
                <tr>
                    <td><?php echo $r->task_name; ?></td>
                    <td><?php echo $r->task_tags; ?></td>
                    <td><?php echo $r->task_date; ?></td>
                    <td><?php echo $r->task_status; ?></td>
                    <td>
                        <a  class="btn btn-warning" href="?c=task&a=Edit&task_id=<?php echo $r->task_id; ?>">Ver</a>
                    </td>
                    <td>
                        <a  class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=task&a=Delete&task_id=<?php echo $r->task_id; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
</form>

</body>
</html>