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
                                Convocatoria: <?php echo $infoConv[0]->nombre_inv . " - " . $infoConv[0]->nombre_rol_inv ?>
                            </label>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formConvocatoria" action="<?php echo base_url('administrador/convocatorias/guardarRequisitos/' . $infoConv[0]->id_convocatoria) ?>" name="formConvocatoria" method="post">
                    <div class="panel-body">

                        <div class="alert alert-danger" role="alert">Requisitos</div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group" id="div_nivel">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Nivel</label>
                                        <select id="nivel" name="nivel" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($m = 0; $m < count($niveles); $m++) {

                                                if ($niveles[$m]->id_nivel == $infoRequ[0]->id_nivel) {
                                                    echo "<option value='" . $niveles[$m]->id_nivel . "' selected>" . $niveles[$m]->descripcion . "</option>";
                                                } else {
                                                    echo "<option value='" . $niveles[$m]->id_nivel . "'>" . $niveles[$m]->descripcion . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>								
                            </div>							
                            <div class="col-md-6">
                                <div class="form-group"  id="div_areacono">
                                    <div class="col-md-12">
                                        <label class="control-label" for="areas">Semestres aprobados</label>
                                        <select id="semestres" name="semestres" class="form-control validate[required]">
                                            <option value="">Seleccione...</option>
                                            <?php
                                            for ($a = 1; $a < 11; $a++) {
                                                if ($a == $infoRequ[0]->semestres) {
                                                    echo "<option value='" . $a . "' selected>" . $a . "</option>";
                                                } else {
                                                    echo "<option value='" . $a . "'>" . $a . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        <?php
                        if (isset($infoRequ[0]->tiempo)) 
                            {
                            $tiempo = $infoRequ[0]->tiempo;
                        }else{
                            $tiempo = '';
                        }
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group" id="div_experiencia">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">Tiempo de experiencia (Meses)</label>
                                        <input type="text" id="experiencia" name="experiencia" class="form-control validate[required]" value="<?php echo $tiempo?>">
                                    </div>
                                </div>								
                            </div>						                        
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="div_ciudad">
                                    <div class="col-md-12">
                                        <label class="control-label" for="nivel">&Aacute;rea de conocimiento</label>
                                        <select id="area" name="area[]" multiple="multiple" class="form-control">
                                            <?php
                                            $areasReg = '';

                                            if ($infoRequ[0]->area) {
                                                $areasReg = explode(",", $infoRequ[0]->area);
                                            }

                                            for ($c = 0; $c < count($areas); $c++) {

                                                if (array_search($areas[$c]->id_programa, $areasReg)) {
                                                    echo "<option value='" . $areas[$c]->id_programa . "' data-section='" . $areas[$c]->desc_areacono . "' selected>" . $areas[$c]->id_programa . " - " . $areas[$c]->desc_programa . "</option>";
                                                } else {
                                                    echo "<option value='" . $areas[$c]->id_programa . "' data-section='" . $areas[$c]->desc_areacono . "'>" . $areas[$c]->id_programa . " - " . $areas[$c]->desc_programa . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>								
                            </div>	
                        </div>

                        <?php
                        $info_ciudad = $this->convocatorias_model->info_por_ciudades($infoConv[0]->id_convocatoria);
                        ?>
                        <div class="row">
                            <div class="table-responsive col-md-8 col-md-offset-2">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Ciudad</th>                     
                                        <th>N&uacute;mero de personas a contratar</th>                                                    
                                        <th>M&aacute;ximo de inscritos </th>                                                    
                                    </tr>
                                    <?php
                                    for ($i = 0; $i < count($info_ciudad); $i++) {
                                        echo "<tr>";
                                        echo "<td>" . $info_ciudad[$i]->nom_mpio . "</td>";
                                        echo "<td><input type='text' class='validate[required,custom[integer],min[1]]' name='contra-" . $info_ciudad[$i]->id_conv_insc . "' value='" . $info_ciudad[$i]->total_personas . "'></td>";
                                        echo "<td><input type='text' class='validate[required]' name='inscri-" . $info_ciudad[$i]->id_conv_insc . "' value='" . $info_ciudad[$i]->max_inscri / 3 . "'></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>                        
                        </div>

                    </div><!--FIN DEL PANEL-->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-danger" onclick="location.replace(<?php echo base_url('administrador/convocatorias/') ?>)">Cancelar</button>
                        <button type="submit" class="btn btn-success" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
