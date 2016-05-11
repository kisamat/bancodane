<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?php echo $this->lang->line('Agregar Producto'); ?></h3>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formCrearActividad" action="<?php echo base_url('coordinador/grupos_trabajo/guardarProducto/'.$datosActividad[0]->id_actividad) ?>" name="formCrearActividad" method="post">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="observacion" class="control-label"><?php echo $this->lang->line('Observaci&oacute;n'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="validate[required] form-control" id="observacion" name="observacion" placeholder="<?php echo $this->lang->line('Registre aqui la observaci&oacute;n'); ?>"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div> 
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="userfile" class="control-label"><?php echo $this->lang->line('Documento'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="file" class="validate[required]" id="documento" name="documento">                            
                        </div>
                    </div> 
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="tags" class="control-label"><?php echo $this->lang->line('Palabras Clave'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="validate[required] form-control" id="tags" name="tags" placeholder="<?php echo $this->lang->line('Registre las palabras clave separadas por coma'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="publico" class="control-label"><?php echo $this->lang->line('Documento Publico'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="validate[required] form-control select2-select" id="publico" name="publico">
                                <option value=""><?php echo $this->lang->line('Seleccione...'); ?></option>
                                <option value="NO"><?php echo $this->lang->line('NO'); ?></option>
                                <option value="SI"><?php echo $this->lang->line('SI'); ?></option>
                            </select>
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