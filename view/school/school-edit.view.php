<div class="card col-md-6 offset-md-3" style="margin-top: 150px;">
    <div class="card-body custom-card-body-1" style="padding-top: 55px;">
        <div class="container-fluid text-center">
            <!-- CONTENIDO DEL CARD BODY -->
            <h1 class="page-header text-center jumbotron">
                <?php echo $school->school_id != null ? 'Escuela ' . '"' . $school->school_nombre . '"' : 'Nuevo Escuela'; ?>
            </h1>
            <div class="container">
                <ol class="breadcrumb">
                <li><a href="?c=school">Escuela</a></li>
                <li class="active"><?php echo $school->school_id != null ? '&nbsp' . $school->school_nombre : '&nbspNuevo Escuela'; ?></li>
                </ol>

                <form id="frm-school" action="?c=school&a=Save" method="post" enctype="multipart/form-data" class="p-5">
                    <input type="hidden" name="school_id" value="<?php echo $school->school_id; ?>" />
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="school_nombre" value="<?php echo $school->school_nombre; ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="school_direccion" value="<?php echo $school->school_direccion; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="school_telefono" value="<?php echo $school->school_telefono; ?>" class="form-control" required>
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
    $(document).ready(function(){
        $("#frm-school").submit(function(){
            return $(this).validate();
        });
    })
</script>

</body>
</html>