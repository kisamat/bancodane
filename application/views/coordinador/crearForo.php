<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?php echo $this->lang->line('Crear Foro'); ?></h3>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formCrearForo" action="<?php echo base_url('coordinador/grupos_trabajo/guardarForo/' . $id_grupo) ?>" name="formCrearForo" method="post">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="tema" class="control-label"><?php echo $this->lang->line('Tema:'); ?></label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="validate[required, min[10]] form-control" id="tema" name="tema"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div> 
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="descripcion" class="control-label"><?php echo $this->lang->line('Descripci&oacute;n'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="validate[required, min[10]] form-control" id="descripcion" name="descripcion"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="categoria" class="control-label"><?php echo $this->lang->line('Categor&iacute;a'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="validate[required] form-control select2-select" id="categoria" name="categoria">
                                <option value=""><?php echo $this->lang->line('Seleccione...'); ?></option>
                                <?php
                                foreach ($categoriasForo as $row) {
                                    echo "<option value='" . $row->id_categoria . "'>" . $row->descripcion . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="tipo" class="control-label"><?php echo $this->lang->line('Tipo de Foro'); ?></label>
                        </div>
                        <div class="col-sm-6">
                            <select class="validate[required] form-control select2-select" id="tipo" name="tipo">
                                <option value=""><?php echo $this->lang->line('Seleccione...'); ?></option>
                                <option value="IN"><?php echo $this->lang->line('Interno'); ?></option>
                                <option value="EX"><?php echo $this->lang->line('Externo'); ?></option>
                                
                            </select>
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
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Guardar'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>