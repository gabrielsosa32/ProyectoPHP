<h1 class="page-header text-center p-3">Gestionador de proyectos</h1>


<form action="" method="post">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-4">
        <div class="container p-3">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control" type="text" name="valueToSearch" placeholder="Buscar un proyecto">
        </div>
        <div class="form-group">
            <input class="btn" type="submit" name="search" value="Buscar">
        </div>
    </div>
</div>

    <div class="table-responsive container">
        <table class="table text-white table-striped  table-hover" id="tabla">
            <thead>
                <tr>
                    <th class="custom-table-1" style="width:180px;">Dueño</th>
                    <th class="custom-table-1" style="width:120px;">Nombre</th>
                    <th class="custom-table-1" style="width:120px;">Fecha de creación</th>          
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
            <?php foreach($this->model->SearchAndList($valueToSearch) as $r): ?>
                <tr>
                    <td><?php echo $r->project_owner; ?></td>
                    <td><?php echo $r->project_name; ?></td>
                    <td><?php echo $r->project_creation_date; ?></td>
                    <td>
                        <a  class="btn btn-warning" href="?c=project&a=Edit&project_id=<?php echo $r->project_id; ?>">Ver</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
</form>

</body>
</html>