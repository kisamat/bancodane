<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"><?php echo $this->lang->line('Registrar Observaci&oacute;n'); ?></h1>
                <form class="form-horizontal" role="form" id="formCrearActividad" action="<?php echo base_url('coordinador/grupos_trabajo/guardarObservacion/'.$datosActividad[0]->id_actividad) ?>" name="formCrearActividad" method="post">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="observacion" class="control-label"><?php echo $this->lang->line('Observaci&oacute;n'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="validate[required] form-control" id="observacion" name="observacion" placeholder="<?php echo $this->lang->line('Registre aqui la nueva observaci&oacute;n'); ?>"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                                                            
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Guardar'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>