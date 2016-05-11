<?php
$errorBD = $this->session->flashdata('errorBD');
if ($errorBD) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $errorBD ?>
    </div>
    <?php
}

$actividadCreada = $this->session->flashdata('actividadCreada');
if ($actividadCreada) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $actividadCreada ?></strong> 
    </div>
    <?php
}

$actividadBorrada = $this->session->flashdata('actividadBorrada');
if ($actividadBorrada) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $actividadBorrada ?></strong> 
    </div>
    <?php
}
?>
<center><h2><?php echo $datosGrupo[0]->nombre_grupo ?></h2></center>
<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <center>
            <a href="<?php echo base_url('coordinador/grupos_trabajo/crearActividad/'.$datosGrupo[0]->id_grupo) ?>">
                <img src="<?php echo base_url('assets/img/actividad.png') ?>">
                <br>
               <?php echo $this->lang->line('Crear Actividad'); ?> 
            </a>
        </center>
    </div>
</div>
<div id="tabsGrupo">
    <ul>
        <li><a href="#tabsGrupo-1">Actividades Pendientes</a></li>
        <!--<li><a href="#tabsGrupo-2">Actividades Resueltas</a></li>-->
    </ul>
    <div id="tabsGrupo-1">
        <table id="grupos1" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Descripci&oacute;n'); ?></th>
                    <th><?php echo $this->lang->line('Requerimiento'); ?></th>
                    <th><?php echo $this->lang->line('Fecha Inicial'); ?></th>
                    <th><?php echo $this->lang->line('Fecha Final'); ?></th>
                    <th><?php echo $this->lang->line('Seguimiento'); ?></th>
                    <th><?php echo $this->lang->line('Editar'); ?></th>
                    <th><?php echo $this->lang->line('Borrar'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ac_pendientes as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->descripcion ?>
                        </td>
                        <td>
                            <?php echo $row->requerimiento ?>
                        </td>
                        <td>
                            <?php echo $row->fecha_inicial ?>
                        </td>                        
                        <td>
                            <?php echo $row->fecha_final ?>
                        </td>  
                        <td>
                            <center>
                                <a href="<?php echo base_url('coordinador/grupos_trabajo/seguimientoActividad/' . $row->id_actividad) ?>">
                                    <img src="<?php echo base_url('assets/img/1day.png') ?>" width="25">
                                </a>
                            </center>
                        </td> 
                        <td>
                            <center>
                                <a href="<?php echo base_url('coordinador/grupos_trabajo/editarActividad/' . $row->id_actividad) ?>">
                                    <img src="<?php echo base_url('assets/img/editar.png') ?>" width="25">
                                </a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a onclick="borrarActividad(<?php echo $row->id_actividad?>,<?php echo $datosGrupo[0]->id_grupo?>)" href="#">
                                    <img src="<?php echo base_url('assets/img/no.png') ?>" width="25">
                                </a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>
    <!--<div id="tabsGrupo-2">
        <table id="grupos2" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Descripci&oacute;n</th>
                    <th>Requerimiento</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Soluci&oacute;n</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ac_resueltas as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->descripcion ?>
                        </td>
                        <td>
                            <?php echo $row->requerimiento ?>
                        </td>
                        <td>
                            <?php echo $row->fecha_inicial ?>
                        </td>                        
                        <td>
                            <?php echo $row->fecha_final ?>
                        </td>          
                        <td>
                            <?php echo $row->solucion ?>
                        </td>  
                        <td>
                            <center>
                                <a href="<?php echo base_url('coordinador/grupos_trabajo/productos/' . $row->id_actividad) ?>">
                                    <img src="<?php echo base_url('assets/img/producto.png') ?>">
                                </a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>-->
</div>


<div id="borrarAct-confirm" title="Borrar Actividad">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $this->lang->line('Esta seguro que quiere borrar esta actividad'); ?></p>
</div>