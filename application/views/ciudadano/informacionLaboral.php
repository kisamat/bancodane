<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <?php echo $retornoExito ?>
    </div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
    <div class="alert alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $retornoError ?>
    </div>
    <?php
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        
        <?php if($datosUsuario[0]->trabaja == "S"){ ?>
            $("#inf-dane").css("display", "block");
        <?php } ?>
        <?php if($datosUsuario[0]->trabaja_dane == "S"){ ?>
            $("#inftrabajo-dane").css("display", "block");
            $('#inftrabajo-nodane').find('input, textarea, button, select').attr('disabled',true);
        <?php }  else { ?>
            $("#inftrabajo-nodane").css("display", "block");
            $('#inftrabajo-dane').find('input, textarea, button, select').attr('disabled',true);
        <?php } ?>
            
        <?php if($laboral[0]->id_tipo_trabajador ==1){ ?>
            $("#tipo-empleado").css("display", "block");
        <?php } else { ?>   
            $("#tipo-indepen").css("display", "block");
        <?php } ?>
    });
</script> 

<div class="section">
    <div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12 text-left">
				<h3 class="text-center">INFORMACIÓN LABORAL</h3>
				</div>
				<div class="col-md-12">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formCrearUsuario" action="<?php echo base_url('ciudadano/principal/actualizarInfoLaboral') ?>" name="formCrearUsuario" method="post">
                    <div class="form-group has-feedback">
                    <div class="col-sm-6 text-left">								  
                        <label class="control-label" for="nivel">¿Trabaja actualmente?</label>
                            <select id="trabajo" name="trabajo" class="form-control validate[required]">
                                <option value="">Seleccione...</option>
                                <option value="S" <?php if($datosUsuario[0]->trabaja == "S"){ echo "selected";} ?> >Si</option>
                                <option value="N" <?php if($datosUsuario[0]->trabaja == "N"){ echo "selected";} ?> >No</option>
                            </select>
			
                    </div>
                    </div>
                    <div id="inf-dane" style="display: none;">
                        <div class="form-group has-feedback">
                        <div class="col-sm-6 text-left">								  
                            <label class="control-label" for="nivel">¿Trabaja en el DANE?</label>
                                <select id="trabajodane" name="trabajodane" class="form-control validate[required]">
                                    <option value="">Seleccione...</option>
                                    <option value="S" <?php if($datosUsuario[0]->trabaja_dane == "S"){ echo "selected";} ?> >Si</option>
                                    <option value="N" <?php if($datosUsuario[0]->trabaja_dane == "N"){ echo "selected";} ?> >No</option>
                                </select>

                        </div>
                    </div>
                    </div>
                    <div id="inftrabajo-dane" style="display: none;">
                        <div class="form-group has-feedback">
                        <div class="col-sm-6 text-left">								  
                            <label class="control-label" for="nivel">¿Tipo de vinculación?</label>
                                <select id="tipovinculacion" name="tipovinculacion" class="form-control validate[required]">
                                    <option value="">Seleccione...</option>
                                    <?php
                                        for($n=0;$n<count($tipovinculacion);$n++)
                                            {
                                                if($tipovinculacion[$n]->id_tipo_vinculacion== $laboral[0]->id_tipo_vinculacion){
                                                    echo "<option value='".$tipovinculacion[$n]->id_tipo_vinculacion."' selected>".$tipovinculacion[$n]->nom_vinculacion."</option>";
                                                }else{
                                                    echo "<option value='".$tipovinculacion[$n]->id_tipo_vinculacion."' >".$tipovinculacion[$n]->nom_vinculacion."</option>";
                                                }
                                            }
                                    ?>
                                </select>

                        </div>
                        <div class="col-sm-6 text-left">								  
                            <label class="control-label" for="nivel">¿dependencia?</label>
                                <select id="dependencia-dane" name="dependencia-dane" class="form-control validate[required]">
                                    <option value="">Seleccione...</option>
                                    <?php
                                        for($n=0;$n<count($dependdane);$n++)
                                            {
                                                if($dependdane[$n]->id_dependencia== $laboral[0]->id_dependencia){
                                                    echo "<option value='".$dependdane[$n]->id_dependencia."' selected >".$dependdane[$n]->nom_dependencia."</option>";
                                                }else{
                                                    echo "<option value='".$dependdane[$n]->id_dependencia."' >".$dependdane[$n]->nom_dependencia."</option>";
                                                }
                                            }
                                    ?>
                                </select>

                        </div>    
                        </div>
                        <div class="form-group has-feedback">
                        <div class="col-sm-6 text-left">
                            <label for="inputClave" class="control-label">Cargo que desempeña:</label>
				<input type="text" value="<?php echo $laboral[0]->cargo?>" class="validate[required] form-control" id="cargo" name="cargo" placeholder="cargo">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>    
                        <div class="col-sm-6 text-left">
                            <label for="inputEmail" class="control-label">Correo Electr&oacute;nico:</label>
				<input type="text" value="<?php echo $laboral[0]->email?>" class="validate[required, custom[email]] form-control" id="inputEmail" name="inputEmail" placeholder="Correo Electr&oacute;nico">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label for="inputClave" class="control-label">Ciudad:</label>
                                   <input type="text" value="<?php echo $laboral[0]->ciudad?>" class="validate[required] form-control" id="inputCiudad" name="inputCiudad" placeholder="Ciudad">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputClave" class="control-label">Dirección:</label>
                                    <input type="text" value="<?php echo $laboral[0]->direccion?>" class="validate[required, ] form-control" id="inputDireccion" name="inputDireccion" placeholder="Dirección">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-8 text-left">
                                <label for="inputClave" class="control-label">Tel&eacute;fono o celular:</label>
                                    <input type="text" value="<?php echo $laboral[0]->telefono?>" class="validate[required] form-control" id="inputTelefono" name="inputTelefono" placeholder="Tel&eacute;fono o celular">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div id="inftrabajo-nodane" style="display: none;">
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">								  
                                <label class="control-label" for="nivel">¿Tipo de trabajador?</label>
                                    <select id="tipotrabajador" name="tipotrabajador" class="form-control validate[required]">
                                        <option value="">Seleccione...</option>
                                        <?php
                                            for($n=0;$n<count($tipotrabajador);$n++)
                                                {
                                                    if($tipotrabajador[$n]->id_tipo_trabajador== $laboral[0]->id_tipo_trabajador){
                                                        echo "<option value='".$tipotrabajador[$n]->id_tipo_trabajador."' selected>".$tipotrabajador[$n]->nom_tipo_trabajador."</option>";
                                                    }else{
                                                        echo "<option value='".$tipotrabajador[$n]->id_tipo_trabajador."' >".$tipotrabajador[$n]->nom_tipo_trabajador."</option>";
                                                    }
                                                }
                                        ?>
                                    </select>

                            </div>
                        </div>
                        <div id="tipo-empleado" style="display: none">
                            <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">								  
                                <label class="control-label" for="nivel">¿Tipo de entidad o institución?</label>
                                    <select id="tipoentidad" name="tipoentidad" class="form-control validate[required]">
                                        <option value="">Seleccione...</option>
                                        <?php
                                            for($n=0;$n<count($tipoEntidad);$n++)
                                                {
                                                    if($tipoEntidad[$n]->id_tipo_entidad== $laboral[0]->id_tipo_entidad){
                                                        echo "<option value='".$tipoEntidad[$n]->id_tipo_entidad."' selected>".$tipoEntidad[$n]->nom_tipo_entidad."</option>";
                                                    }else{
                                                        echo "<option value='".$tipoEntidad[$n]->id_tipo_entidad."' >".$tipoEntidad[$n]->nom_tipo_entidad."</option>";
                                                    }
                                                }
                                        ?>
                                    </select>

                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputClave" class="control-label">Entidad o Institución donde trabaja:</label>
                                        <input type="text" value="<?php echo $laboral[0]->entidad?>" class="validate[required, ] form-control" id="inputEntidad" name="inputEntidad" placeholder="Entidad">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>  
                            </div>                            
                            <div class="form-group has-feedback">
                                <div class="col-sm-6 text-left">
                                    <label for="inputClave" class="control-label">Cargo que desempeña:</label>
                                        <input type="text" value="<?php echo $laboral[0]->cargo?>" class="validate[required] form-control" id="cargo" name="cargo" placeholder="cargo">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>    
                                <div class="col-sm-6 text-left">
                                    <label for="inputEmail" class="control-label">Dependencia:</label>
                                        <input type="text" value="<?php echo $laboral[0]->dependencia?>" class="validate[required] form-control" id="inputDependencia" name="inputDependencia" placeholder="Dependencia">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-6 text-left">
                                    <label class="control-label" for="pais">Pa&iacute;s</label>
                                        <select id="pais" name="pais" class="form-control validate[required]">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        for($m=0;$m<count($paises);$m++)
                                            {
                                                if($paises[$m]->codi_pais== $laboral[0]->codi_pais){
                                                    echo "<option value='".$paises[$m]->codi_pais."' selected>".$paises[$m]->desc_pais."</option>";
                                                }else{
                                                    echo "<option value='".$paises[$m]->codi_pais."'>".$paises[$m]->desc_pais."</option>";
                                                }
                                            }
                                        ?>
                                        </select>                                
                                </div>
                                <div class="col-sm-6 text-left">
                                    <label for="inputClave" class="control-label">Ciudad:</label>
                                        <input type="text" value="<?php echo $laboral[0]->ciudad?>" class="validate[required] form-control" id="inputCiudad" name="inputCiudad" placeholder="Ciudad">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-6 text-left">
                                    <label for="inputClave" class="control-label">Dirección:</label>
                                        <input type="text" value="<?php echo $laboral[0]->direccion?>" class="validate[required, ] form-control" id="inputDireccion" name="inputDireccion" placeholder="Dirección">
                                    <span class="fa fa-check form-control-feedback"></span>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <label for="inputClave" class="control-label">Tel&eacute;fono o celular:</label>
                                        <input type="text" value="<?php echo $laboral[0]->telefono?>" class="validate[required] form-control" id="inputTelefono" name="inputTelefono" placeholder="Tel&eacute;fono o celular">
                                    <span class="fa fa-check form-control-feedback"></span>                                    
                                </div>
                            </div>                            
                        </div>
                        <div id="tipo-indepen" style="display: none" >
                            <div class="form-group has-feedback">
                                <div class="col-sm-10 text-left">								  
                                    <label class="control-label" for="nivel">¿Actividad Económica?</label>
                                        <select id="acteconomica" name="acteconomica" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                                for($n=0;$n<count($actEcono);$n++)
                                                    {
                                                        if($actEcono[$n]->id_actividad_economica== $laboral[0]->id_actividad_economica){
                                                            echo "<option value='".$actEcono[$n]->id_actividad_economica."' selected>".$actEcono[$n]->nom_actividad_economica."</option>";
                                                        }else{
                                                            echo "<option value='".$actEcono[$n]->id_actividad_economica."' >".$actEcono[$n]->nom_actividad_economica."</option>";
                                                        }
                                                    }
                                            ?>
                                        </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <a class="btn btn-danger" type="button" href="<?php echo base_url()?>"><i class="fa fa-fw fa-arrow-left"></i>Regresar</a>
                            <input type="hidden" name="idformato" value="<?php echo $laboral[0]->id_info_laboral; ?>" />
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-pencil-square-o"></i>Actualizar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>