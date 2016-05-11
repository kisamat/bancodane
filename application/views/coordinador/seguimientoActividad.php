<?php
$observacionCreada = $this->session->flashdata('observacionCreada');
if ($observacionCreada) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $observacionCreada ?></strong> 
    </div>
    <?php
}

$productoOk = $this->session->flashdata('productoOk');
if ($productoOk) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $productoOk ?></strong> 
    </div>
    <?php
}

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

$errorProducto = $this->session->flashdata('errorProducto');
if ($errorProducto) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $errorProducto ?>
    </div>
    <?php
}
?>

<center><h2><?php echo $datosActividad[0]->descripcion ?></h2></center>
<div id="tabsGrupo">
    <ul>        
        <li><a href="#tabsGrupo-2"><?php echo $this->lang->line('Productos'); ?></a></li>
        <li><a href="#tabsGrupo-1"><?php echo $this->lang->line('Observaciones Registradas'); ?></a></li>
    </ul>
    <div id="tabsGrupo-1">
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <center>
                    <a href="<?php echo base_url('coordinador/grupos_trabajo/observacionActividad/' . $datosActividad[0]->id_actividad) ?>">
                        <img src="<?php echo base_url('assets/img/observacion.png') ?>">
                        <br>
                        <?php echo $this->lang->line('Agregar Observaci&oacute;n'); ?>
                    </a>
                </center>
            </div>
        </div>
        <fieldset class="table-bordered">
            <legend><?php echo $this->lang->line('Listado de Observaciones'); ?></legend>
        <table id="grupos1" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Observaci&oacute;n'); ?></th>
                    <th><?php echo $this->lang->line('Fecha'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($observaciones as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->observaciones ?>
                        </td>
                        <td>
                            <?php echo $row->fecha ?>
                        </td>                          
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
        </fieldset>
    </div>   
    <div id="tabsGrupo-2">
        <div class="row">
            <div class="col-md-6">
                <center>
                    <a href="<?php echo base_url('coordinador/grupos_trabajo/agregarProducto/' . $datosActividad[0]->id_actividad) ?>">
                        <img src="<?php echo base_url('assets/img/observacion.png') ?>">
                        <br>
                        <?php echo $this->lang->line('Agregar Producto'); ?>
                    </a>
                </center>
            </div>   
            <div class="col-md-6">
                <center>
                    <a href="<?php echo base_url('coordinador/grupos_trabajo/agregarActa/' . $datosActividad[0]->id_actividad) ?>">
                        <img src="<?php echo base_url('assets/img/acroread.png') ?>">
                        <br>
                        <?php echo $this->lang->line('Agregar Acta'); ?>
                    </a>
                </center>
            </div>
        </div>
        <fieldset class="table-bordered">
            <legend>Listado de Productos</legend>
            <table id="grupos2" class="table table-striped table-bordered display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('Observaci&oacute;n'); ?></th>
                        <th><?php echo $this->lang->line('Fecha'); ?></th>
                        <th><?php echo $this->lang->line('Archivo'); ?></th>
                        <th><?php echo $this->lang->line('Tags'); ?></th>                    
                        <th><?php echo $this->lang->line('P&uacute;blico'); ?></th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($productos as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row->observacion ?>
                            </td>
                            <td>
                                <?php echo $row->fecha ?>
                            </td>                          
                            <td>
                                <a href="<?php echo base_url('uploads/' . $row->nombre) ?>" target="_blank"><?php echo $row->nombre ?></a>
                            </td>
                            <td>
                                <?php echo $row->tags ?>
                            </td>                          
                            <td>
                                <?php
                                if ($row->es_publico == 1) {
                                    echo "SI";
                                } else {
                                    echo "NO";
                                }
                                ?>
                            </td>                         
                        </tr>
                        <?php
                    }
                    ?>
                <tbody>
            </table>
        </fieldset>

    </div>     
</div>

