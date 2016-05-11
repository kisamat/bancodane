<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"><?php echo $this->lang->line('Invitaci&oacute;n'); ?> - <?php echo $datosGrupo[0]->nombre_grupo ?></h1>
                <form class="form-horizontal" role="form" id="formCrearActividad" action="<?php echo base_url('coordinador/grupos_trabajo/enviarInvitacion/'.$datosGrupo[0]->id_grupo) ?>" name="formCrearActividad" method="post">

                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="correoMiembro" class="control-label"><?php echo $this->lang->line('Correo Electronico:'); ?></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="validate[required, custom[email]] form-control" id="correoMiembro" name="correoMiembro" placeholder="<?php echo $this->lang->line('Correo Electr&oacute;nico:'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-4 text-right">
                            <label for="mensaje" class="control-label"><?php echo $this->lang->line('Mensaje Adicional:'); ?></label>
                        </div>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="mensaje" name="mensaje" placeholder="<?php echo $this->lang->line('Mensaje de invitaci&oacute;n'); ?>"></textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                                                            
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Enviar Mensaje'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>