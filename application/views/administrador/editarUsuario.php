<?php 
    $correoRegistrado = $this->session->flashdata('correoRegistrado');
    if ($correoRegistrado) 
    {
    ?>
       <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $correoRegistrado ?>
      </div>
    <?php
    }
    
    $identificacionRegistrado = $this->session->flashdata('identificacionRegistrado');
    if ($identificacionRegistrado) 
    {
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
                        <h1 class="text-center"><?php echo $this->lang->line('Administraci&oacute;n de Usuarios'); ?></h1>
                        <form class="form-horizontal" role="form" id="formEditarUsuario" action="<?php echo base_url('administrador/usuarios/actualizarUsuario')?>" name="formEditarUsuario" method="post">
                            <div class="form-group has-feedback">
                                <div class="col-sm-4 text-right">
                                    <label for="inputNombres" class="control-label"><?php echo $this->lang->line('Nombres'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $datosUsuario[0]->id_usuario?>">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputNombres" name="inputNombres" placeholder="<?php echo $this->lang->line('Nombres'); ?>" value="<?php echo $datosUsuario[0]->nombres?>">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-4 text-right">
                                    <label for="inputApellidos" class="control-label"><?php echo $this->lang->line('Apellidos'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputApellidos" name="inputApellidos" placeholder="<?php echo $this->lang->line('Apellidos'); ?>" value="<?php echo $datosUsuario[0]->apellidos?>">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-4 text-right">
                                    <label for="inputCargo" class="control-label"><?php echo $this->lang->line('Cargo'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputCargo" name="inputCargo" placeholder="<?php echo $this->lang->line('Cargo'); ?>" value="<?php echo $datosUsuario[0]->cargo?>">
									<input type="hidden" name="hidCargo" id="hidCargo">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-4 text-right">
                                    <label for="inputEspeci" class="control-label"><?php echo $this->lang->line('Especialidad'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputEspeci" name="inputEspeci" placeholder="<?php echo $this->lang->line('Especialidad'); ?>" value="<?php echo $datosUsuario[0]->especialidad?>">
									<input type="hidden" name="hidEspeci" id="hidEspeci">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-4 text-right">
                                    <label for="inputEmail" class="control-label"><?php echo $this->lang->line('Correo Electr&oacute;nico'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="validate[required, custom[email]] form-control" id="inputEmail" name="inputEmail" placeholder="<?php echo $this->lang->line('Correo Electr&oacute;nico'); ?>" value="<?php echo $datosUsuario[0]->email?>">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 text-right">
                                    <label class="control-label"><?php echo $this->lang->line('Pa&iacute;s'); ?> - INE:</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="validate[required] form-control select2-select" id="pais" name="pais">
									
									<?php									
									foreach($paises as $pa)
									{
                                                                            if($pa->codi_pais == $datosUsuario[0]->codi_pais)
                                                                                {
                                                                                    echo "<option value='".$pa->codi_pais."' selected>".$pa->desc_pais."</option>";
                                                                                }else
                                                                                    {
                                                                                        echo "<option value='".$pa->codi_pais."'>".$pa->desc_pais."</option>";
                                                                                    }
										
									}
									
									?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-sm-4 text-right">
                                    <label class="control-label"><?php echo $this->lang->line('Tipo de Usuario'); ?>:</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="validate[required] form-control" id="rol_usuario" name="rol_usuario">
									<?php									
									foreach($roles as $ro)
									{
                                                                            if($ro->id_rol == $datosUsuario[0]->rol)
                                                                                {
                                                                                    echo "<option value='".$ro->id_rol."' selected>".$ro->descripcion."</option>";
                                                                                }else
                                                                                    {
                                                                                        echo "<option value='".$ro->id_rol."'>".$ro->descripcion."</option>";
                                                                                    }
									}
									
									?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2 text-center">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Actualizar'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>