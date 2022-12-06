<div class="card col-md-10 offset-md-1" style="margin-top: 150px;">
    <div class="card-body" style="padding-top: 55px;">
        <div class="container-fluid text-center">
        <div class="container p-3">
            <h1 class="page-header">
                <?php echo $request->request_id != null ? $request->request_id : 'Nueva Solicitud'; ?>
            </h1>

            <ol class="breadcrumb">
                <li><a href="?c=user">Solicitud</a></li>
                <li class="active"><?php echo $request->request_id != null ? '&nbsp' . $request->request_id : '&nbspNueva Solicitud'; ?></li>
            </ol>
        </div>
        <div class="container">
            <form id="frm-user" action="?c=user&a=Save" method="post" enctype="multipart/form-data" class="text-left">
                <input type="hidden" name="request_id" value="<?php echo $request->request_id; ?>" />
                <div class="form-group">
                    <label>Tipo de solicitud:</label>
                    <select class="form-control" name="request_tipo">
                            <option default value="<?php echo $request->request_tipo; ?>"><?php echo $request->request_tipo; ?></option>
                            <option value="Cambio de datos">Cambio de datos</option>
                            <option value="Promoción de nivel en el sistema">Promoción de nivel en el sistema</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Solicitante</label>
                    <input type="text" name="request_solicitante" value="<?php echo $userDetails->username; ?>" class="form-control" readonly required>
                </div>
                <div class="form-group">
                    <label>Detalle:</label>
                    <textarea name="request_detalle" class="form-control" cols="30" rows="10">
                    <?php echo $request->request_detalle; ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Estado:</label>
                    <select class="form-control" name="request_estado">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Denegado">Denegado</option>
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