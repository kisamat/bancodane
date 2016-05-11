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
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="nav">				
                        <div class="btn-group pull-left" data-toggle="buttons">
                            <label>
                                Convocatorias en las que esta participando actualmente
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <?php
                                if (count($conv_participando)>0) {
                                    for ($p = 0; $p < count($conv_participando); $p++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $conv_participando[$p]->nombre_inv . " - " . $conv_participando[$p]->nombre_rol_inv ?></td>
                                            <td>
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" style="color: yellow"> </span>  En proceso<br>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color: red"> </span> No tiene participaci&oacute;n en ninguna convocatoria<br>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div> 

                </div>
            </div> 

            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="nav">				
                        <div class="btn-group pull-left" data-toggle="buttons">
                            <label>
                                Convocatorias Abiertas
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel-body">


                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <?php
                                for ($i = 0; $i < count($conv_abiertas); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $conv_abiertas[$i]->nombre_inv . " - " . $conv_abiertas[$i]->nombre_rol_inv ?></td>
                                        <td>
                                            <a class='btn btn-info' href='<?php echo base_url('ciudadano/convocatorias/aplicar/' . $conv_abiertas[$i]->id_convocatoria) ?>'>
                                                <span class="glyphicon glyphicon-ok" style="color: greenyellow" aria-hidden="true"> </span>  Aplicar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div> 

                </div>
            </div>   

            <?php
            if (count($conv_cerradas) > 0) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <div class="nav">				
                            <div class="btn-group pull-left" data-toggle="buttons">
                                <label>
                                    Invitaciones
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <?php
                                        for ($c = 0; $c < count($conv_cerradas); $c++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $conv_cerradas[$c]->nombre_inv . " - " . $conv_cerradas[$c]->nombre_rol_inv ?></td>
                                                <td>
                                                    <a class='btn btn-info' href='<?php echo base_url('ciudadano/convocatorias/aplicar/' . $conv_cerradas[$c]->id_convocatoria) ?>'>
                                                        <span class="glyphicon glyphicon-ok" style="color: greenyellow" aria-hidden="true"> </span>  Aplicar
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div> 	
            <?php }?>
            </div>		
        </div>
    </div>

    <!-- Modal de Formacion Academica -->
    <div class="modal fade bs-example-modal-lg" id="modalConvocatoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Convocatorias</h4>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formConvocatoria" action="<?php echo base_url('administrador/convocatorias/guardarConvocatoria') ?>" name="formConvocatoria" method="post">
                    <div class="modal-body">
                        <div class="row">                        
                            <div class="col-md-6">
                                <label class="control-label" for="graduado">Tipo de convocatoria</label>
                                <div class="radio">
                                    <label for="tipo_conv-0">
                                        <input class="validate[required]" type="radio" name="tipo_conv" id="tipo_conv" value="A">
                                        Abierta
                                    </label>									
                                    <label for="tipo_conv-1">
                                        <input class="validate[required]" type="radio" name="tipo_conv" id="tipo_conv" value="C">
                                        Invitaci&oacute;n
                                    </label>
                                </div>
                            </div>							
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group" id="div_modalidad">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Investigaci&oacute;n</label>
                                        <select id="investigacion" name="investigacion" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($m = 0; $m < count($investigaciones); $m++) {
                                                echo "<option value='" . $investigaciones[$m]->id_investigacion . "'>" . $investigaciones[$m]->nombre_inv . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>								
                            </div>							
                            <div class="col-md-6">
                                <div class="form-group"  id="div_areacono">
                                    <div class="col-md-12">
                                        <label class="control-label" for="areas">Rol</label>
                                        <select id="rol" name="rol" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($a = 0; $a < count($roles); $a++) {
                                                echo "<option value='" . $roles[$a]->id_rol_inv . "'>" . $roles[$a]->nombre_rol_inv . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="div_perfil">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Perfil</label>
                                        <textarea class="form-control validate[required]" name="perfil" id="perfil" rows="2"></textarea>
                                    </div>
                                </div>								
                            </div>	
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="div_objeto">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Objeto</label>
                                        <textarea class="form-control validate[required]" name="objeto" id="objeto" rows="2"></textarea>
                                    </div>
                                </div>								
                            </div>	
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="div_obligacion">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Obligaciones</label>
                                        <textarea class="form-control validate[required]" name="obligaciones" id="obligaciones" rows="2"></textarea>
                                    </div>
                                </div>								
                            </div>	
                        </div>
                        <div class="row">	
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-6">
                                    <div class="form-group">				
                                        <label class="control-label" for="textinput">Fecha de Inicio</label>
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="fechaInicio" id="fechaInicio" readonly />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-6">
                                    <div class="form-group">								  
                                        <label class="control-label" for="textinput">Fecha de Finalizaci&oacute;n</label>  
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="fechaFin" id="fechaFin" readonly />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>									
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="div_ciudad">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Ciudad o ciudades donde se va a realizar</label>
                                        <select id="ciudades" name="ciudades[]" multiple="multiple" class="form-control validate[funcCall[ifSelectNotEmpty]]">
                                            <?php
                                            for ($c = 0; $c < count($ciudades); $c++) {
                                                echo "<option value='" . $ciudades[$c]->id_mpio . "' data-section='" . $ciudades[$c]->nomb_terri . "'>" . $ciudades[$c]->nom_mpio . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>								
                            </div>	
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" >Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal de Experiencia -->
    <div class="modal fade bs-example-modal-lg" id="modalExperiencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabelExp">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabelExp">Experiencia Laboral</h4>
                    <h6><font color="red">Los datos de experiencia se deben suministrar por cada uno de los contratos realizados</font></h6>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formExperiencia" action="<?php echo base_url('ciudadano/principal/guardarExperiencia') ?>" name="formFormacion" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Empresa</label>
                                        <div class="input-group input-append" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="empresa" id="empresa" />
                                        </div>
                                    </div>
                                </div>								
                            </div>							
                            <div class="col-lg-3">
                                <div class="form-group">	
                                    <label class="control-label" for="nivel">Tipo Empresa</label>
                                    <div class="radio">
                                        <label for="tipoem-0">
                                            <input class="validate[required]" type="radio" name="tipoem" id="tipoem" value="PU">
                                            P&uacute;blica
                                        </label>									
                                        <label for="tipoem-1">
                                            <input class="validate[required]" type="radio" name="tipoem" id="tipoem" value="PR">
                                            Privada
                                        </label>
                                    </div>
                                </div>
                            </div>	
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Dependencia</label>
                                        <div class="input-group input-append" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="dependencia" id="dependencia" />
                                        </div>
                                    </div>
                                </div>								
                            </div>	
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Cargo</label>
                                        <div class="input-group input-append" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="cargo" id="cargo" />
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                        <div class="row">
                            <div class="col-md-4">								
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="pais">Pa&iacute;s</label>
                                        <select id="pais" name="pais" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($m = 0; $m < count($paises); $m++) {
                                                echo "<option value='" . $paises[$m]->codi_pais . "'>" . $paises[$m]->desc_pais . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>	
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="departamento">Departamento</label>
                                        <select id="departamento" name="departamento" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($n = 0; $n < count($departamento); $n++) {
                                                echo "<option value='" . $departamento[$n]->id_nivel . "'>" . $departamento[$n]->descripcion . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>								
                            </div>							
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label" for="municipio">Municipio</label>
                                        <select id="municipio" name="municipio" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($a = 0; $a < count($municipio); $a++) {
                                                echo "<option value='" . $municipio[$a]->id_areacono . "'>" . $municipio[$a]->desc_areacono . "</option>";
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>							
                    </div>
                    <div class="row">	
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="nivel">Direcci&oacute;n</label>
                                            <div class="input-group input-append" id="datePicker">
                                                <input type="text" class="form-control validate[required]" name="direccion" id="direccion" />
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="nivel">Tel&eacute;fono</label>
                                            <div class="input-group input-append" id="datePicker">
                                                <input type="text" class="form-control validate[required]" name="telefono" id="telefono" />
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="nivel">Correo Electr&oacute;nico Entidad</label>
                                            <div class="input-group input-append" id="datePicker">
                                                <input type="text" class="form-control validate[custom[email]]" name="correo" id="correo" />
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>							
                    </div>
                    <br>
                    <div class="row">	
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row">	
                                <div class="col-md-4">
                                    <div class="form-group">				
                                        <label class="control-label" for="textinput">Fecha de Ingreso</label>
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="fechaIng" id="fechaIng" readonly />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">								  
                                        <label class="control-label" for="textinput">Fecha de retiro</label>  
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control validate[required]" name="fechaRet" id="fechaRet" readonly />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>									
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">								  
                                        <label class="control-label" for="textinput">Trabajo aqui actualmente</label>  
                                        <input type="checkbox" class="form-control" name="fechaAct" id="fechaAct"/>								
                                    </div>
                                </div>
                            </div>
                        </div>							
                    </div>						
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <label class="control-label" for="textinput">Adjuntar Soporte</label>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="doc_experiencia" name="doc_experiencia" class="file file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" data-show-remove="false" data-allowed-file-extensions='["pdf"]' >
                                </div>
                            </div>
                        </div>							
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" >Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>


