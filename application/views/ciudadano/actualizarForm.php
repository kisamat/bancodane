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

<div class="section">
    <div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12 text-left">
				<h3 class="text-center">ACTUALIZACI&Oacute;N FORMACI&Oacute;N ACAD&Eacute;MICA</h3>
				</div>
				<div class="col-md-12">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formFormacion" action="<?php echo base_url('ciudadano/principal/actualizarFormacion') ?>" name="formFormacion" method="post">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										  <div class="col-md-12">
											<label class="control-label" for="nivel">Nivel de Estudios</label>
											<select id="nivel" name="nivel" class="form-control validate[required]">
											  <option value="">Seleccione...</option>
											  <?php
												for($n=0;$n<count($niveles);$n++)
												{
													if($formacionUsuario[0]->id_nivel == $niveles[$n]->id_nivel){
														echo "<option value='".$niveles[$n]->id_nivel."' selected>".$niveles[$n]->descripcion."</option>";
													}else
													{
														echo "<option value='".$niveles[$n]->id_nivel."'>".$niveles[$n]->descripcion."</option>";
													}
													
												}
											  ?>
											</select>
										  </div>
									</div>																
								</div>
								<div class="col-md-4">								
									<div class="form-group">
										  <div class="col-md-12">
											<label class="control-label" for="nivel">Semestres Aprobados</label>
											<select id="semestres" name="semestres" class="form-control validate[required]">
											  <option value="">Seleccione...</option>
											  <?php
												for($ns=1;$ns <= 10;$ns++)
												{
													if($formacionUsuario[0]->semestres == $ns)
													{
														echo "<option value='".$ns."' selected>".$ns."</option>";
													}else{
														echo "<option value='".$ns."'>".$ns."</option>";	
													}
													
												}
											  ?>
											</select>
										  </div>
									</div>
								</div>
								<div class="col-md-4">
									<?php
										if($formacionUsuario[0]->id_nivel < 8)
										{
											$styleVal = "style='display: block'";
										}else{
											$styleVal = "style='display: none'";
										}
									?>
									<div class="form-group" id="div_graduado" <?php echo $styleVal?>>								  
									  <label class="control-label" for="graduado">Graduado</label>
									  <div class="radio">
										<label for="graduado-0">
										  <input class="validate[required]" type="radio" name="graduado" id="graduado" value="S" <?php if($formacionUsuario[0]->graduado == "S"){ echo "checked";} ?>>
											Si
										</label>									
										<label for="graduado-1">
										  <input class="validate[required]" type="radio" name="graduado" id="graduado" value="N" <?php if($formacionUsuario[0]->graduado == "N"){ echo "checked";} ?>>
											No
										</label>
										</div>
									</div>
								</div>							
							</div>
							<br><br>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										  <div class="col-md-12">
											<label class="control-label" for="nivel">Modalidad</label>
											<select id="modalidad" name="modalidad" class="form-control validate[required]">
											  <option value="">Seleccione...</option>
											  <?php
												for($m=0;$m<count($modalidades);$m++)
												{
													if($formacionUsuario[0]->id_modalidad == $modalidades[$m]->id_modalidad)
													{
														echo "<option value='".$modalidades[$m]->id_modalidad."' selected>".$modalidades[$m]->desc_modalidad."</option>";
													}else
													{
														echo "<option value='".$modalidades[$m]->id_modalidad."'>".$modalidades[$m]->desc_modalidad."</option>";	
													}
													
												}
											  ?>
											</select>
										  </div>
									</div>								
								</div>							
								<div class="col-md-3">
									<div class="form-group">
										  <div class="col-md-12">
											<label class="control-label" for="areas">&Aacute;rea de Conocimiento</label>
											<select id="areas" name="areas" class="form-control validate[required]">
											  <option value="">Seleccione...</option>
											  <?php
												for($a=0;$a<count($areas);$a++)
												{
													if($formacionUsuario[0]->id_areacono == $areas[$a]->id_areacono)
													{
														echo "<option value='".$areas[$a]->id_areacono."' selected>".$areas[$a]->desc_areacono."</option>";
													}else{
														echo "<option value='".$areas[$a]->id_areacono."'>".$areas[$a]->desc_areacono."</option>";
													}
												}
											  ?>
											</select>
										  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										  <div class="col-md-12">
											<label class="control-label" for="programa">Programa Acad&eacute;mico</label>
											<select id="programa" name="programa" class="form-control validate[required]" style="width: 100%">
											  <?php
												$programas = $this->perfil_model->programaAcademico($formacionUsuario[0]->id_areacono);
												foreach($programas as $fila)
												{
													if($formacionUsuario[0]->id_programa == $fila -> id_programa)
													{
														echo "<option value=".$fila -> id_programa ." selected>".$fila -> desc_programa."</option>";
													}else{
														echo "<option value=".$fila -> id_programa .">".$fila -> desc_programa."</option>";
													}
												}
											  ?>
											</select>
										  </div>
									</div>
								</div>
							</div>
							<br><br>
							<div id="div_valGraduado" <?php echo $styleVal?>>
							<div class="row">							
								<div class="col-md-5 col-md-offset-1">
									<div class="form-group">				
										<label class="control-label" for="textinput">Fecha de Terminaci&oacute;n</label>
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control validate[required,past[#fechaTarj]]" name="fechaTerm" id="fechaTerm" readonly <?php if($formacionUsuario[0]->fechaTermina != "0000-00-00"){ echo "value='".$formacionUsuario[0]->fechaTermina."'";} ?> />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>	
								<div class="col-md-5">
									<div class="form-group">								  
										<label class="control-label" for="textinput">Fecha de Expedici&oacute;n Tarjeta Profesional</label>  
										<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control validate[required,future[#fechaTerm]]" name="fechaTarj" id="fechaTarj" readonly  <?php if($formacionUsuario[0]->fechaTarje != "0000-00-00"){ echo "value='".$formacionUsuario[0]->fechaTarje."'";} ?>/>
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>		
							</div>						
							<br><br>
							<div class="row">
								<div class="col-md-6" id>														
									<label class="control-label" for="textinput">Soporte Formaci&oacuten Acad&eacute;mica</label>																											
									<div class="form-group" id="actSopForm">
										<div class="col-md-12">
											<input id="doc_formacion" name="doc_formacion" class="file  file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" data-show-remove="false" data-allowed-file-extensions='["pdf"]' >
										</div>
									</div>
								</div>
								<div class="col-md-6">														
									<label class="control-label" for="textinput">Tarjeta Profesional</label>
									<div class="form-group">
										<div class="col-md-12">
											<input id="doc_tarjeta" name="doc_tarjeta" class="file file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false"  data-show-remove="false" data-allowed-file-extensions='["pdf"]'>
										</div>
									</div>
								</div>
							</div>
							</div>
				  </div>
				  <div class="col-sm-8 col-sm-offset-2 text-center">
					<input type="hidden" id="id_formacion" name="id_formacion" value="<?php echo $formacionUsuario[0]->id_formacion?>">
					<a class="btn btn-danger" type="button" href="<?php echo base_url()?>"><i class="fa fa-fw fa-arrow-left"></i>Regresar</a>
					<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-pencil-square-o"></i>Actualizar</button>
				  </div>
				  </form>
            </div>
        </div>
    </div>
</div>