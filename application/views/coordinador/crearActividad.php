<?php
$correoRegistrado = $this->session->flashdata('correoRegistrado');
if ($correoRegistrado) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $correoRegistrado ?>
    </div>
    <?php
}

$identificacionRegistrado = $this->session->flashdata('identificacionRegistrado');
if ($identificacionRegistrado) {
    ?>
    <div class="alert alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $identificacionRegistrado ?>
    </div>
    <?php
}
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"><?php echo $this->lang->line('Crear Actividad'); ?> - <?php echo $datosGrupo[0]->nombre_grupo ?></h1>
                <form class="form-horizontal" role="form" id="formCrearActividad" action="<?php echo base_url('coordinador/grupos_trabajo/guardarActividad/'.$datosGrupo[0]->id_grupo) ?>" name="formCrearActividad" method="post">

                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="inputDescripcion" class="control-label"><?php echo $this->lang->line('Descripci&oacute;n'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="validate[required] form-control" id="inputDescripcion" name="inputDescripcion" placeholder="<?php echo $this->lang->line('Descripci&oacute;n de la actividad'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="inputFechini" class="control-label"><?php echo $this->lang->line('Fecha Inicial'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="validate[required] form-control" id="inputfechini" name="inputfechini" placeholder="<?php echo $this->lang->line('Fecha de Inicio de la Actividad'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                    
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="inputFechfin" class="control-label"><?php echo $this->lang->line('Fecha Final'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="validate[required] form-control" id="inputfechfin" name="inputfechfin" placeholder="<?php echo $this->lang->line('Fecha de Finalizaci&oacute;n de la Actividad'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                    
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="inputRequerimiento" class="control-label"><?php echo $this->lang->line('Requerimiento'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea type="text" class="validate[required] form-control" id="inputRequerimiento" name="inputRequerimiento" placeholder="<?php echo $this->lang->line('Requerimiento de la actividad'); ?>"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><?php echo $this->lang->line('Miembros Responsables'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="validate[required] form-control select2-select" multiple="true" id="miembros" name="miembros[]">
                                    <?php
                                    foreach ($miembros as $pa) {
                                        echo "<option value='" . $pa->id_usuario . "'>" . $pa->nombres ." ". $pa->apellidos ."</option>";
                                    }
                                    ?>
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