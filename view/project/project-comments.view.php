<div class="card col-md-6 offset-md-3" style="margin-top: 150px;">
    <div class="card-body custom-card-body-1" style="padding-top: 55px;">
        <div class="container-fluid text-center">
            <!-- CONTENIDO DEL CARD BODY -->
            <h1 class="page-header text-center jumbotron">
                <?php echo $project->project_id != null ? 'Proyecto ' . '"' . $project->project_titulo . '"' : 'Nuevo Proyecto'; ?>
            </h1>
            <div class="container">
                <ol class="breadcrumb">
                <li><a href="?c=project">Proyecto</a></li>
                <li class="active"><?php echo $project->project_id != null ? '&nbsp' . $project->project_titulo : '&nbspNuevo Proyecto'; ?></li>
                </ol>

                <form id="frm-project" action="?c=project&a=Save" method="post" enctype="multipart/form-data" class="p-5">
                    <input type="hidden" name="project_id" value="<?php echo $project->project_id; ?>" />
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="project_titulo" value="<?php echo $project->project_titulo; ?>" class="form-control" readonly required>
                    </div>
                    
                    <div class="form-group">
                        <label>Subtítulo</label>
                        <input type="text" name="project_subtitulo" value="<?php echo $project->project_subtitulo; ?>" class="form-control" readonly required>
                    </div>
                    
                    <div class="form-group">
                        <label>Resumen</label>
                        <textarea name="project_resumen" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_resumen; ?>
                        </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Problemática</label>
                        <textarea name="project_problematica" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_problematica; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Interrogante</label>
                        <textarea name="project_interrogante" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_interrogante; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Objetivo</label>
                        <textarea name="project_objetivo" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_objetivo; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Solución</label>
                        <textarea name="project_solucion" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_solucion; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Prueba y Conclusión</label>
                        <textarea name="project_pruebayconclusion" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_pruebayconclusion; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Integrantes</label>
                        <textarea name="project_integrantes" form="frm-project" cols="30" rows="10" readonly class="form-control">
                            <?php echo $project->project_integrantes; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Escuela</label>
                        <input type="text" name="project_escuela" value="<?php echo $userEscuela; ?>" class="form-control" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Comentarios</label>
                        <textarea name="project_comentarios" form="frm-project" cols="30" rows="10" class="form-control">
                            <?php echo $project->project_comentarios; ?>
                        </textarea>
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
        $("#frm-project").submit(function(){
            return $(this).validate();
        });
    })
</script>

</body>
</html>