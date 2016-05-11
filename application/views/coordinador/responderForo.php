<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?php echo $this->lang->line('Responder Foro'); ?></h3>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formRespuestaForo" action="<?php echo base_url('coordinador/grupos_trabajo/guardarRespuesta/') ?>" name="formRespuestaForo" method="post">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="respuesta" class="control-label"><?php echo $this->lang->line('Respuesta'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="validate[required, min[50]] form-control" id="respuesta" name="respuesta" placeholder="<?php echo $this->lang->line('Registre aqu&iacute; la respuesta al tema del foro'); ?>"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div> 
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="userfile" class="control-label"><?php echo $this->lang->line('Documento'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="file" class="" id="documento" name="documento">                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <input type="hidden" name="id_foro" value="<?php echo $id_foro?>">
                            <input type="hidden" name="id_grupo" value="<?php echo $id_grupo?>">
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Guardar'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>