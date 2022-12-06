<h1 class="page-header text-center jumbotron">
    <?php echo $task->task_id != null ? 'Tarea ' . '"' . $task->task_name . '"' : 'Nueva Tarea'; ?>
</h1>
<div class="container">
    <ol class="breadcrumb">
    <li><a href="?c=task">Tarea</a></li>
    <li class="active"><?php echo $task->task_id != null ? '&nbsp' . $task->task_name : '&nbspnueva Tarea'; ?></li>
    </ol>

    <form id="frm-task" action="?c=task&a=Save" method="post" enctype="multipart/form-data" class="p-5">
        <input type="hidden" name="task_id" value="<?php echo $task->task_id; ?>" />
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="task_name" value="<?php echo $task->task_name; ?>" class="form-control" placeholder="Ingrese nombre para su tarea" required>
        </div>
        
        <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="task_description" value="<?php echo $task->task_description; ?>" class="form-control" placeholder="Ingrese una descripción para su tarea" required>
        </div>
        
        <div class="form-group">
            <label>Etiquetas</label>
            <input type="text" name="task_tags" value="<?php echo $task->task_tags; ?>" class="form-control" placeholder="Ingrese etiquetas o palabras claves para categorizar su tarea" required>
        </div>
        
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="task_date" value="<?php echo $task->task_date; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <input type="number" name="task_status" value="<?php echo $task->task_status; ?>" class="form-control" placeholder="Establecer estado para la tarea" required>
        </div>
            
        
        <hr />
        
        <div class="text-right">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#frm-task").submit(function(){
            return $(this).validate();
        });
    })
</script>

</body>
</html>