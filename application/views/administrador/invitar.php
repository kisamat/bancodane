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
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <div class="nav">				
                            <div class="btn-group pull-left" data-toggle="buttons">
                                <label>
                                    Invitaci&oacute;n a convocatoria cerrada
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formFormacion" action="<?php echo base_url('ciudadano/principal/guardarInvitacion/' . $idConv) ?>" name="formFormacion" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="tipo_iden">Tipo de identificaci&oacute;n</label>
                                            <select id="nivel" name="tipo_iden" class="form-control validate[required]">
                                                <option value="">Seleccione...</option>
                                                <option value="">Cedula de Ciudadania</option>                                  
                                            </select>
                                        </div>
                                    </div>																
                                </div>
                                <div class="col-md-6">								
                                    <div class="form-group" id="div_semestres">
                                        <div class="col-md-12">
                                            <label class="control-label" for="nume_iden">N&uacute;mero de identificaci&oacute;n</label>
                                            <input type="text" class="form-control validate[required]" name="nume_iden" id="nume_iden" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="nombre">Nombres</label>
                                            <input type="text" class="form-control validate[required]" name="nombre" id="nombre" />
                                        </div>
                                    </div>																
                                </div>
                                <div class="col-md-6">								
                                    <div class="form-group" id="div_semestres">
                                        <div class="col-md-12">
                                            <label class="control-label" for="apellido">Apellidos</label>
                                            <input type="text" class="form-control validate[required]" name="apellido" id="apellido" />
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="correo">Correo electr&oacute;nico</label>
                                            <input type="text" class="form-control validate[required]" name="correo" id="correo" />
                                        </div>
                                    </div>																
                                </div>
                                <div class="col-md-6">								
                                    <div class="form-group" id="div_semestres">
                                        <div class="col-md-12">
                                            <label class="control-label" for="conf_correo">Confirmar correo electr&oacute;nico</label>
                                            <input type="text" class="form-control validate[required]" name="conf_correo" id="conf_correo" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="telefono">Tel&eacute;fono Fijo</label>
                                            <input type="text" class="form-control validate[required]" name="telefono" id="telefono" />
                                        </div>
                                    </div>																
                                </div>
                                <div class="col-md-6">								
                                    <div class="form-group" id="div_semestres">
                                        <div class="col-md-12">
                                            <label class="control-label" for="celular">Tel&eacute;fono Celular</label>
                                            <input type="text" class="form-control validate[required]" name="celular" id="celular" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row-centered">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" >Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <div class="nav">				
                            <div class="btn-group pull-left" data-toggle="buttons">
                                <label>
                                    Carga masiva de usuarios
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formFormacion" action="<?php echo base_url('administrador/convocatorias/cargarInvitaciones/' . $idConv) ?>" name="formFormacion" method="post">
                            <div class="col-md-8 col-md-offset-2" id="div_carga">
                                <div class="form-group">
                                    <div class="row-centered">
                                        <div class="col-md-8 col-md-offset-2">
                                            <a href=""><span class="glyphicon glyphicon-list-alt"></span>  Descargar Plantilla</a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="doc_excel" name="doc_excel" class="file  file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" data-show-remove="false" data-allowed-file-extensions='["xls"]' >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row-centered">
                                        <button type="submit" class="btn btn-success" >Validar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading text-right">
                        <div class="nav">				
                            <div class="btn-group pull-left" data-toggle="buttons">
                                <label>
                                    Listado de usuarios
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="my-table">
                                <thead>
                                    <tr>
                                        <th>Persona</th>
                                        <th>Estado Correo Enviado</th>
                                        <th>Aplica Sistema</th>                                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($usuariosInvitados); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $usuariosInvitados[$i]->nombres . " " . $usuariosInvitados[$i]->apellidos . "<br>" . $usuariosInvitados[$i]->tipo_iden . " - " . $usuariosInvitados[$i]->nume_iden ?></td>
                                            <td>
                                                <?php
                                                if ($usuariosInvitados[$i]->envio_email == 'NO') {
                                                    ?>
                                                    <a class='btn btn-info' href='<?php echo base_url('administrador/convocatorias/enviarCorreo/' . $usuariosInvitados[$i]->id_convocatoria . "/" . $usuariosInvitados[$i]->id_usuario) ?>'>
                                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span>  Enviar correo
                                                    </a>    
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>  Correo enviado<br>
                                                    <?php
                                                    echo $usuariosInvitados[$i]->fecha_correo;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($usuariosInvitados[$i]->aplico == 'NO') {
                                                    ?>
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red"> </span>  No aplic&oacute; en el sistema<br>    
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green"> </span>  Aplic&oacute; en el sistema<br>
                                                    <?php
                                                    echo $usuariosInvitados[$i]->fecha_aplico;
                                                }
                                                ?>
                                            </td>                    
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>