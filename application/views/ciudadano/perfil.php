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

$hv = 20;
$class = 'progress-bar-danger';
if($datosUsuario[0]->id_avatar != 0 && $datosUsuario[0]->rutaDI!= '')
{
	$hv = $hv + 20;
	$classhv = 'progress-bar-danger';
}

if(count($formacionUsuario)>0)
{
	$hv = $hv + 30;
	$classhv = 'progress-bar-warning';
}

if(count($experienciaUsuario)>0)
{
	$hv = $hv + 30;
	$classhv = 'progress-bar-success';
}

if($hv >= 0 && $hv <= 40)
{
	$classhv = 'progress-bar-danger';
}else if($hv >= 40 && $hv <= 80)
{
	$classhv = 'progress-bar-warning';
}else if($hv >= 80 && $hv <= 100)
{
	$classhv = 'progress-bar-success';
}

if(count($experienciaUsuario)>0)
    {
        $dias = 0;
        for($j=0;$j<count($experienciaUsuario);$j++)
            {
                    if($experienciaUsuario[$j]->fecha_retiro == '0000-00-00')
                    {
                            $fechaRetiro = 'Actualmente';
                            $fechaCalcular = date('Y-m-d');
                    }else
                    {
                            $fechaRetiro = $experienciaUsuario[$j]->fecha_retiro;
                            $fechaCalcular = $experienciaUsuario[$j]->fecha_retiro;
                    }

                    $fechainicial = new DateTime($experienciaUsuario[$j]->fecha_ingreso);
                    $fechafinal = new DateTime($fechaCalcular);

                    $diferencia = $fechainicial->diff($fechafinal);

                    $dias = $dias + $diferencia->days;								

            }

            $mesesExperiencia = $dias/30; 
            $aniosExperiencia = $mesesExperiencia/12; 

            $tiempo = explode(".",$aniosExperiencia);
            $anio = $tiempo[0];
            $mes = "0.".$tiempo[1];
            $mesExperiencia = $mes*12;
            $tiempoExperiencia = intval($anio)." A&ntilde;os  -  ".intval($mesExperiencia)." Meses";
    }else
        {
            $tiempoExperiencia = "0 A&ntilde;os  -  0 Meses";
        }
 
	
?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">

            <!-- Heading 
            ================================================== -->
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="nav">
                    <div class="btn-group pull-left" data-toggle="buttons">
			<label>
			Perfil
                        </label>
                    </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <?php
					if($datosUsuario[0]->id_avatar == 0)
					{
						?>
						<img class="propic" id="imgSalida" src="<?php echo base_url('assets/img/avatar.png')?>" width="160" alt="">
						<?php
					}else
					{						
						?>
						<img class="propic" id="imgSalida" src="<?php echo base_url('uploads/avatar/'.$datosUsuario[0]->nombA)?>" width="160" alt="">
						<?php
					}
                                    ?>
                                               <br />
                                               
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cambiarAvatar">
				  <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Cambiar Imagen
				</button>
                                <!--inicio modal foto-->
                                <div class="modal fade bs-example-modal-lg" id="cambiarAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Cambiar Imagen de Perfil</h4>
					  </div>
					  <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formCargaAvatar" action="<?php echo base_url('ciudadano/principal/cargaAvatar') ?>" name="formCargaAvatar" method="post">
					  <div class="modal-body">
							<div class="col-md-10 col-md-offset-1">
								<label class="control-label" for="textinput">Seleccione una imagen en formato JPG o PNG no mayor a 2Mb</label>
								<div class="form-group">
								  <div class="col-md-12">
									<input id="doc_avatar" name="doc_avatar" class="file file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-show-remove="false" data-allowed-file-extensions='["jpg","png"]' >
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
                                <!-- final modal foto -->
                                </td>
                                <td>
                                    <h3><?php echo $datosUsuario[0]->nombres." ".$datosUsuario[0]->apellidos;?></h3>
                                    <h4><b>N&uacute;mero de Identificaci&oacute;n: </b><?php echo $datosUsuario[0]->nume_iden?></h5>
                                    <h5><b>Nacionalidad: </b><?php echo $datosUsuario[0]->desc_pais?></h5>
                                    <h5><b>Fecha de Nacimiento: </b><?php echo date($datosUsuario[0]->fecha_naci)?></h5>
                                    <h5><b>T&eacute;lefono: </b><?php echo $datosUsuario[0]->telefono?></h5>
                                    <h5><b>Celular: </b><?php echo $datosUsuario[0]->celular?></h5>
                                    <h5><b>Genero: </b><?php echo $datosUsuario[0]->desc_gene?></h5>
                                    <h5><b>Correo Electr&oacute;nico Principal: </b><?php echo $datosUsuario[0]->usuario?></h5>
                                    <h5><b>Correo Electr&oacute;nico Secundario: </b><?php echo $datosUsuario[0]->email2?></h5>
                                    <h5><b>Hoja de vida actualizada en el SIGEP: </b><?php if($datosUsuario[0]->sigep == "S"){echo "SI";}else{echo "NO";}?></h5>
                                    <h5><b>Tiempo de Experiencia: </b><?php echo $tiempoExperiencia?></h5>
                                </td>
                                <td>
                                    <p>
                                        <?php
                                            if($datosUsuario[0]->rutaDI != '')
                                            {
                                                echo "<br><a href='".base_url('uploads/'.$datosUsuario[0]->nombDI)."' target='_blank'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Ver Documento Identificaci&oacute;n</a>";
                                            }else{
                                                echo "<br><span class='glyphicon glyphicon-file' aria-hidden='true'></span><font color='red'> Falta Documento Identificaci&oacute;n</font>";
                                            }
					?>
                                    </p>
                                    <p>
                                        <?php
                                            if($datosUsuario[0]->genero == 'M')
                                            {
                                                if($datosUsuario[0]->rutaLM != '')
						{
                                                    echo "<br><a href='".base_url('uploads/'.$datosUsuario[0]->nombLM)."' target='_blank'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Ver Libreta Militar</a>";
                                                }else{
                                                    echo "<br><span class='glyphicon glyphicon-file' aria-hidden='true'></span><font color='red'> Falta Libreta Militar</font>";
                                                }
                                            }							
					?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>            
<!-- header end-->		

        <div class="panel panel-default">
			<div class="panel-heading text-right">
				<div class="nav">				
					<div class="btn-group pull-left" data-toggle="buttons">
					  <label>
						Formaci&oacute;n Acad&eacute;mica
					  </label>
					</div>

					<div class="btn-group pull-right" data-toggle="buttons">					  
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormacion">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>A&ntilde;adir
						</button>
					</div>
				</div>
			</div>
		  <div class="panel-body">
			 <div class="table-responsive">
			  <table class="table table-striped">
				<?php
				if(count($formacionUsuario)>0)
				{
					/*echo "<pre>";
					print_r($formacionUsuario);
					echo "</pre>";*/
					for($i=0;$i<count($formacionUsuario);$i++)
					{
						?>
						<tr>
							<td>
							<?php
								echo "<b>".$formacionUsuario[$i]->desc_programa."</b><br>";
								echo "Nivel:".$formacionUsuario[$i]->descripcion."</b><br>";
								echo $formacionUsuario[$i]->semestres." Semestres ";
								if($formacionUsuario[$i]->id_nivel < 8 && $formacionUsuario[$i]->graduado == 'S' )
								{
									echo "-  Fecha de grado: ".$formacionUsuario[$i]->fechaTermina;
								}
								
								
								if($formacionUsuario[$i]->rutaF != '')
								{
									echo "<br><a href='".base_url('uploads/'.$formacionUsuario[$i]->nombF)."' target='_blank'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Ver Soporte</a>";
								}
								if($formacionUsuario[$i]->rutaT != '')
								{
									echo "<br><a href='".base_url('uploads/'.$formacionUsuario[$i]->nombF)."' target='_blank'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Ver tarjeta profesional</a>";
								}
								$idActualizar = strrev(base64_encode($formacionUsuario[$i]->id_formacion));
							?>
							</td>
							<td>
								<a type="button" class="btn btn-info" href="<?php echo base_url('ciudadano/principal/modificarFormacion/'.$idActualizar) ?>">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar
								</a>								
							</td>
							<td>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelFormacion-<?php echo $formacionUsuario[$i]->id_formacion?>">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar
								</button>
								<div class="modal fade bs-example-modal-lg" id="modalDelFormacion-<?php echo $formacionUsuario[$i]->id_formacion?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Borrar Formaci&oacute;n Acad&eacute;mica</h4>
									  </div>
									  <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formEliminarForm" action="<?php echo base_url('ciudadano/principal/borrarFormacion/'.$formacionUsuario[$i]->id_formacion) ?>" name="formEliminarForm" method="post">
									  <div class="modal-body">
											Seguro quiere eliminar este registro de formaci&oacute;n acad&eacute;mica
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success" >Aceptar</button>
									  </div>
									  </form>
									</div>
								  </div>
								</div>
							</td>
						</tr>
						<?php
					}
				}else
				{
					echo "No se encontraron registros";
				}
				?>
			  </table>
			</div> 
		  </div>
		</div>   
		
		
		<div class="panel panel-default">
			<div class="panel-heading text-right">
				<div class="nav">				
					<div class="btn-group pull-left" data-toggle="buttons">
					  <label>
						Experiencia Laboral
					  </label>
					</div>

					<div class="btn-group pull-right" data-toggle="buttons">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalExperiencia">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>A&ntilde;adir
						</button>
					</div>
				</div>
			</div>
		  <div class="panel-body">
			<div class="table-responsive">
			  <table class="table table-striped">
				<?php
				if(count($experienciaUsuario)>0)
				{
					for($j=0;$j<count($experienciaUsuario);$j++)
					{
						if($experienciaUsuario[$j]->fecha_retiro == '0000-00-00')
						{
							$fechaRetiro = 'Actualmente';
							$fechaCalcular = date('Y-m-d');
						}else
						{
							$fechaRetiro = $experienciaUsuario[$j]->fecha_retiro;
							$fechaCalcular = $experienciaUsuario[$j]->fecha_retiro;
						}
						?>
						<tr>
							<td>
							<?php
								echo "<b>".$experienciaUsuario[$j]->empresa."</b><br>";
								echo $experienciaUsuario[$j]->cargo." - ".$experienciaUsuario[$j]->dependencia."<br>";
								echo $experienciaUsuario[$j]->direccion."<br>";
								echo $experienciaUsuario[$j]->telefono."<br>";
								echo "Fecha de Ingreso: ".$experienciaUsuario[$j]->fecha_ingreso."    Fecha de Retiro: ".$fechaRetiro."<br>";
								
								$fechainicial = new DateTime($experienciaUsuario[$j]->fecha_ingreso);
								$fechafinal = new DateTime($fechaCalcular);
								
								$diferencia = $fechainicial->diff($fechafinal);
								
								$años = $diferencia->y;
								$meses = $diferencia->m;
								$dias = $diferencia->d;								
								$diasExperiencia = $años." Años - ".$meses." Meses - ".$dias." Dias ";							
								
								echo "<b>Experiencia: ".$diasExperiencia."</b><br>";
								
								if($experienciaUsuario[$j]->rutaE != '')
								{
									echo "<a href='".base_url('uploads/'.$experienciaUsuario[$j]->nombE)."' target='_blank'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Ver Soporte</a> <br>";
								}
								
								$idActualizarExp = strrev(base64_encode($experienciaUsuario[$j]->id_experiencia));
							?>
							</td>
							<td>
								<a type="button" class="btn btn-info" href="<?php echo base_url('ciudadano/principal/modificarExperiencia/'.$idActualizarExp) ?>">
								  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar
								</a>								
							</td>
							<td>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelExperiencia-<?php echo $experienciaUsuario[$j]->id_experiencia?>">
								  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar
								</button>
								<div class="modal fade bs-example-modal-lg" id="modalDelExperiencia-<?php echo $experienciaUsuario[$j]->id_experiencia?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Borrar Experiencia Laboral</h4>
									  </div>
									  <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formEliminarExp" action="<?php echo base_url('ciudadano/principal/borrarExperiencia/'.$experienciaUsuario[$j]->id_experiencia) ?>" name="formEliminarExp" method="post">
									  <div class="modal-body">
											Seguro quiere eliminar este registro de experiencia laboral	
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-success" >Aceptar</button>
									  </div>
									  </form>
									</div>
								  </div>
								</div>
							</td>
						</tr>
						<?php
					}
				}else
				{
					echo "No se encontraron registros";
				}
				?>
			  </table>
			</div> 
		  </div>
		</div> 		 
	</div>		
</div>
</div>

<!-- Modal de Formacion Academica -->
		<div class="modal fade bs-example-modal-lg" id="modalFormacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Formaci&oacute;n Acad&eacute;mica</h4>
			  </div>
			  <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formFormacion" action="<?php echo base_url('ciudadano/principal/guardarFormacion') ?>" name="formFormacion" method="post">
			  <div class="modal-body">
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
												echo "<option value='".$niveles[$n]->id_nivel."'>".$niveles[$n]->descripcion."</option>";
											}
										  ?>
										</select>
									  </div>
								</div>																
							</div>
							<div class="col-md-4">								
								<div class="form-group" id="div_semestres">
									  <div class="col-md-12">
										<label class="control-label" for="nivel">Semestres Aprobados</label>
										<select id="semestres" name="semestres" class="form-control validate[required]">
										  <option value="">Seleccione...</option>
										  <?php
											for($ns=1;$ns <= 10;$ns++)
											{
												echo "<option value='".$ns."'>".$ns."</option>";
											}
										  ?>
										</select>
									  </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" id="div_graduado">								  
								  <label class="control-label" for="graduado">Graduado</label>
								  <div class="radio">
									<label for="graduado-0">
									  <input class="validate[required]" type="radio" name="graduado" id="graduado" value="S">
										Si
									</label>									
									<label for="graduado-1">
									  <input class="validate[required]" type="radio" name="graduado" id="graduado" value="N">
									  No
									</label>
									</div>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group" id="div_modalidad">
									  <div class="col-md-12">
										<label class="control-label" for="nivel">Modalidad</label>
										<select id="modalidad" name="modalidad" class="form-control validate[required]">
										  <option value="">Seleccione...</option>
										  <?php
											for($m=0;$m<count($modalidades);$m++)
											{
												echo "<option value='".$modalidades[$m]->id_modalidad."'>".$modalidades[$m]->desc_modalidad."</option>";
											}
										  ?>
										</select>
									  </div>
								</div>								
							</div>							
							<div class="col-md-3">
								<div class="form-group"  id="div_areacono">
									  <div class="col-md-12">
										<label class="control-label" for="areas">&Aacute;rea de Conocimiento</label>
										<select id="areas" name="areas" class="form-control validate[required]">
										  <option value="">Seleccione...</option>
										  <?php
											for($a=0;$a<count($areas);$a++)
											{
												echo "<option value='".$areas[$a]->id_areacono."'>".$areas[$a]->desc_areacono."</option>";
											}
										  ?>
										</select>
									  </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" id="div_programa">
									  <div class="col-md-12">
										<label class="control-label" for="programa">Programa Acad&eacute;mico</label>
										<select id="programa" name="programa" class="form-control validate[required]" style="width: 100%">
										  <option value="">Seleccione area de conocimiento y nivel...</option>
										</select>
									  </div>
								</div>
							</div>
						</div>
						<br>
						<div id="div_valGraduado">
                                                <div class="row">							
                                                    <div class="col-md-6" id="div_fechatermi">
                                                            <label class="control-label" for="textinput">Fecha de Terminaci&oacute;n</label>
                                                            <div class="form-group">
                                                              <div class="col-md-10 col-md-offset-1 input-group input-append date" id="datePicker">
                                                                    <input type="text" class="form-control validate[required,past[#fechaTarj]]" name="fechaTerm" id="fechaTerm" readonly />
                                                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                              </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6" id="div_fechatarje">
                                                            <label class="control-label" for="textinput">Fecha de Expedici&oacute;n Tarjeta Profesional</label>
                                                            <div class="form-group">
                                                              <div class="col-md-10 col-md-offset-1 input-group input-append date" id="datePicker">
                                                                    <input type="text" class="form-control validate[required,future[#fechaTerm]]" name="fechaTarj" id="fechaTarj" readonly />
                                                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                              </div>
                                                            </div>
                                                    </div>		
						</div>
						<div class="row">
							<div class="col-md-6" id="div_sopforma">
								<label class="control-label" for="textinput">Soporte Formaci&oacuten Acad&eacute;mica</label>
								<div class="form-group">
								  <div class="col-md-12">
									<input id="doc_formacion" name="doc_formacion" class="file  file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" data-show-remove="false" data-allowed-file-extensions='["pdf"]' >
								  </div>
								</div>
							</div>
							<div class="col-md-6" id="div_soptarje">
								<label class="control-label" for="textinput">Soporte Tarjeta Profesional</label>
								<div class="form-group">
								  <div class="col-md-12">
									<input id="doc_tarjeta" name="doc_tarjeta" class="file  file-loading validate[required]" type="file" data-show-upload="false" data-show-caption="true" data-show-preview="false" data-show-remove="false" data-allowed-file-extensions='["pdf"]' >
								  </div>
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
											for($m=0;$m<count($paises);$m++)
											{
												echo "<option value='".$paises[$m]->codi_pais."'>".$paises[$m]->desc_pais."</option>";
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
											for($n=0;$n<count($departamento);$n++)
											{
												echo "<option value='".$departamento[$n]->id_nivel."'>".$departamento[$n]->descripcion."</option>";
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
											for($a=0;$a<count($municipio);$a++)
											{
												echo "<option value='".$municipio[$a]->id_areacono."'>".$municipio[$a]->desc_areacono."</option>";
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
		
		
		