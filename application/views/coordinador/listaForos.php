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

$foroCreado = $this->session->flashdata('foroCreado');
if ($foroCreado) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $foroCreado ?></strong> 
    </div>
    <?php
}
?>
<div class="row">
    <div class="col-lg-12">
        <center>
            <a href="<?php echo base_url('coordinador/grupos_trabajo/crearForo/' . $id_grupo) ?>">
                <img src="<?php echo base_url('assets/img/responder.png') ?>"> <br>                              
                <?php echo $this->lang->line('Crear Foro'); ?>
            </a>
        </center>
    </div>
</div>
<div id="tabsGrupo">
    <ul>
        <li><a href="#tabsGrupo-1"><?php echo $this->lang->line('Administraci&oacute;n de Foros'); ?></a></li>
    </ul>
    <div id="tabsGrupo-1">
        <table id="grupos1" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Categor&iacute;a'); ?></th>
                    <th><?php echo $this->lang->line('Tema'); ?></th>
                    <th><?php echo $this->lang->line('Autor'); ?></th>
                    <th><?php echo $this->lang->line('Archivo'); ?></th>
                    <th><?php echo $this->lang->line('&uacute;ltima Respuesta'); ?></th>
                    <th><?php echo $this->lang->line('Total Respuestas'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($forosGrupo as $row) {

                    $ultimaResp = $this->grupos_model->ultRespuesta($row->id_foro);
                    $totalResp = $this->grupos_model->totalRespuesta($row->id_foro);
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url('coordinador/grupos_trabajo/foroDetalle/' . $id_grupo . "/" . $row->id_foro) ?>">
                                <?php echo $row->descripcion ?>                               
                            </a>

                        </td>
                        <td>
                            <a href="<?php echo base_url('coordinador/grupos_trabajo/foroDetalle/' . $id_grupo . "/" . $row->id_foro) ?>">
                                <?php echo $row->foro_tema ?>                               
                            </a>

                        </td>                        
                        <td>
                            <a href="<?php echo base_url('coordinador/grupos_trabajo/foroDetalle/' . $id_grupo . "/" . $row->id_foro) ?>">
                                <?php echo $row->nombres . " " . $row->apellidos ?><br>
                                <?php echo $row->email ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            if (trim($row->ruta) != '') {
                                ?>
                                <a href="<?php echo base_url('uploads/' . $row->nombre) ?>" target="_blank">
                                    <i class="fa fa-fw fa-file"></i><?php echo $row->nombre ?>
                                </a>
                                <?php
                            } else {
                                echo $this->lang->line('Sin archivo');
                            }
                            ?>                            
                        </td>
                        <td>
                            <a href="<?php echo base_url('coordinador/grupos_trabajo/foroDetalle/' . $id_grupo . "/" . $row->id_foro) ?>">
                                <?php
                                if($ultimaResp[0]->respuesta_fecha != '')
                                    {
                                        echo $ultimaResp[0]->respuesta_fecha ?><br>
                                        Por <?php echo $ultimaResp[0]->respuesta_nombre . " - " . $ultimaResp[0]->respuesta_email; 
                                    }else
                                        {
                                            echo $this->lang->line('Sin respuestas');
                                        }
                                
                                ?>
                            </a>
                        </td> 
                        <td>
                            <a href="<?php echo base_url('coordinador/grupos_trabajo/foroDetalle/' . $id_grupo . "/" . $row->id_foro) ?>">
    <?php echo $totalResp[0]->total ?><br>           
                            </a>
                        </td>                         
                    </tr>
    <?php
}
?>
            <tbody>
        </table>
    </div>
</div>

