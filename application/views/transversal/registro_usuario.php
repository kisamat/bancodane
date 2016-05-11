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

<div class="section" style="background-image: url(<?php echo base_url('assets/img/registro.jpg');?>);">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
        	<div class="row" style="background-color: #A1134D; opacity: 0.9; z-index: -10000;">
        		<p><center><h1 style="color: #FFFFFF">BANCO</h1></center></p>
        		<p><center><h1 style="color: #FFFFFF"><b>DE HOJAS DE VIDA</b></h1></center></p>
        	</div>
            <div class="row" style="background-color: white; opacity: 0.9; z-index: 10000;">
                <div class="col-md-12 text-center">
                    <center><h4 class="text-center">&Uacute;nete al <b>banco de hojas de vida</b> y podr&aacute;s participar de las convocatorias del personal operativo de las <b>investigaciones del DANE</b></h4></center>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" id="formCrearUsuario" action="<?php echo base_url('transversal/registro_usuario/guardarUsuario') ?>" name="formCrearUsuario" method="post">
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label for="inputTipoIden" class="control-label">Tipo identificaci&oacute;n:</label>
                                <select class="validate[required] form-control select2-select" id="tipo_iden" name="tipo_iden">
                                    <option value=''>Seleccione...</option>
                                    <option value='CC'>C&eacute;dula de Ciudadan&iacute;a</option>                                
                                </select>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputNombres" class="control-label">N&uacute;mero identificaci&oacute;n:</label>
                                <input type="text" class="validate[required, custom[onlyNumberSp]] form-control" id="inputNumeIden" name="inputNumeIden" placeholder="N&uacute;mero de identificaci&oacute;n">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label for="inputNombres" class="control-label">Nombres:</label>
                                <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputNombres" name="inputNombres" placeholder="Nombres">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputApellidos" class="control-label">Apellidos:</label>
                                <input type="text" class="validate[required, custom[onlyLetterSp]] form-control" id="inputApellidos" name="inputApellidos" placeholder="Apellidos">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label for="inputEmail" class="control-label">Correo electr&oacute;nico:</label>
                                <input type="text" class="validate[required, custom[email]] form-control" id="inputEmail" name="inputEmail" placeholder="Correo electr&oacute;nico">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputEmail" class="control-label">Confirmar correo electr&oacute;nico:</label>
                                <input type="text" class="validate[required, custom[email]] form-control" id="inputEmailConf" name="inputEmailConf" placeholder="Confirmar correo electr&oacute;nico">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>                    
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label for="inputClave" class="control-label">Contrase&ntilde;a:</label>
                                <input type="password" class="validate[required] form-control" id="inputClave" name="inputClave" placeholder="Clave de acceso">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="inputClave" class="control-label">Confirmar contrase&ntilde;a:</label>
                                <input type="password" class="validate[required] form-control" id="inputClaveConf" name="inputClaveConf" placeholder="Confirmar clave de acceso">
                                <span class="fa fa-check form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-6 text-left">
                                <label class="control-label">Fecha de nacimiento:</label>
                                <div class="input-group input-append date" id="datePicker">
                                    <input type="text" class="form-control validate[required]" name="fechaNaci" id="fechaNaci" />
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <div class="col-sm-6 text-left">
                                <label class="control-label">Genero:</label>
                                <br>
                                <input class="validate[required]" type="radio" name="sexo" id="sexo" value="F">   Mujer
                                <input class="validate[required]" type="radio" name="sexo" id="sexo" value="M">   Hombre
                            </div>
                        </div>	
                        <div class="form-group has-feedback">
                            <div class="col-sm-12 text-center">
                                Al hacer <b>clic</b> en <b>"Registrarse"</b>, aceptas las condiciones y confirmas que leiste los <a href="#" data-toggle="modal" data-target="#modalConvocatoria">terminos y condiciones de uso</a>
                            </div>                        
                        </div>	
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2 text-center">
                                <button class="btn btn-success" style="background-color: #AD124B; color: #FFFFFF" type="submit"><i class="fa fa-fw fa-check"></i>Registrarse</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Formacion Academica -->
<div class="modal fade bs-example-modal-lg" id="modalConvocatoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Terminos y Condiciones</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pulvinar ipsum nec enim vulputate, in dignissim felis imperdiet. Nullam leo enim, congue at tempor et, sagittis et justo. Fusce diam eros, ultrices at congue non, ornare sit amet ipsum. Integer varius ex placerat, lacinia arcu vitae, commodo libero. Sed sagittis nisl id tortor suscipit, eu pulvinar justo facilisis. Maecenas non nulla vitae enim commodo vulputate vel eget urna. Fusce eleifend justo mauris, bibendum laoreet augue convallis vitae. Proin cursus velit vel dictum varius. Quisque vestibulum justo neque, quis pretium quam tempor vel. Nulla vitae pretium dui. Integer nec porttitor mi. Etiam vitae aliquet ex.</p>

                        <p>Curabitur pharetra turpis felis, eget egestas est tincidunt at. Fusce dapibus mollis consequat. Integer pellentesque tortor odio, ut finibus felis tincidunt non. Fusce urna libero, convallis sit amet nulla interdum, ultricies hendrerit magna. Nam sit amet luctus urna, at pulvinar augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer semper risus at placerat cursus. Suspendisse congue euismod purus condimentum volutpat. Vestibulum dictum fringilla quam, sed posuere ex posuere eu. Cras consequat arcu nulla, placerat tempor neque euismod auctor. Phasellus ut faucibus eros. Phasellus sed euismod risus. Fusce sapien massa, porta sed velit quis, sodales ultrices dolor. Sed augue ipsum, sollicitudin a neque sit amet, cursus consectetur nibh. Aenean a congue risus.</p>

                        <p>Nam eget nibh a elit tristique aliquam. Praesent luctus odio sapien. Suspendisse efficitur sagittis erat. Nulla eu odio ullamcorper, malesuada magna nec, lobortis purus. Suspendisse potenti. Phasellus ullamcorper rutrum neque, at cursus dui imperdiet sed. Sed nec sollicitudin libero. Aliquam pretium consectetur metus, non tempor nulla facilisis id. Pellentesque risus libero, consequat sit amet massa ac, imperdiet vehicula lacus. Sed venenatis vel sem vel lobortis. Sed facilisis lacus ut justo suscipit, ut auctor leo ultrices. Proin fringilla nisl in massa dignissim, ut accumsan ex faucibus. Duis eu justo massa. Mauris aliquam rhoncus enim, id volutpat mauris scelerisque rutrum. Nam accumsan nibh elit, vel tincidunt tellus vulputate eu.</p>

                        <p>Donec porttitor eros a nulla dignissim, eget laoreet augue commodo. Ut libero urna, interdum eget nisl laoreet, egestas maximus ipsum. Donec vel scelerisque ex. Etiam quis imperdiet mauris. Vivamus sed metus nec diam consequat efficitur. Integer eu accumsan magna. Quisque viverra tortor tortor, non bibendum est dictum in. Sed in malesuada nunc. Nulla laoreet scelerisque eros, vel semper nunc condimentum finibus. Mauris imperdiet, risus non semper porttitor, arcu lorem congue sem, eu ullamcorper metus purus sit amet nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed congue orci non enim volutpat eleifend. Sed vitae dapibus nunc. Nunc ultrices vulputate dolor, vel viverra augue pretium ut.</p>

                        <p>Cras justo orci, aliquam ut varius eu, accumsan sit amet risus. Nullam sed feugiat felis. Nulla dignissim ante nec odio imperdiet elementum. Sed auctor mollis bibendum. Mauris et felis vitae purus eleifend vestibulum eget nec neque. Aenean eleifend consequat tortor quis scelerisque. In malesuada lectus sem, et maximus ipsum aliquam id. Morbi elementum condimentum quam, vel porta augue dignissim tincidunt. Aenean in orci quis nulla tristique pretium vel vitae sapien. Fusce accumsan gravida augue, sed consectetur diam sodales at. Integer tristique sem id ligula suscipit, vel facilisis sem fermentum. Proin velit ante, vehicula nec mauris nec, fermentum cursus mauris. Nullam lorem mi, mollis et risus nec, sollicitudin accumsan augue. Fusce nec lorem posuere, tincidunt purus non, iaculis erat. Morbi et orci lacinia, hendrerit magna non, feugiat velit.</p>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
