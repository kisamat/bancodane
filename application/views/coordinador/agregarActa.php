<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Nueva Acta</h3>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" id="formActa" action="<?php echo base_url('coordinador/grupos_trabajo/generarActa/' . $datosActividad[0]->id_actividad) ?>" name="formActa" method="post">
                    <div class="form-group has-feedback center">
                        <div class="col-sm-12">
                            <textarea class="validate[required] form-control" id="acta" name="acta" rows="20">
                                <p>&nbsp;</p>
                                <table style="height: 79px;" width="877">
                                <tbody>
                                <tr>
                                <td><strong><?php echo $this->lang->line('PARTICIPACI&Oacute;N'); ?>:</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <ol>
                                            <li>A</li>
                                            <li>B</li>
                                            <li>C</li>
                                        </ol>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <table style="height: 79px;" width="877">
                                <tbody>
                                <tr>
                                <td><strong><?php echo $this->lang->line('OBJETIVOS'); ?>:</strong></td>
                                </tr>
                                <tr>
                                <td>
                                    <ol>
                                        <li>A</li>
                                        <li>B</li>
                                        <li>C</li>
                                    </ol>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp; </p>
                                <table style="height: 79px;" width="877">
                                <tbody>
                                <tr>
                                <td><strong><?php echo $this->lang->line('ACUERDOS'); ?>:</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <ol>
                                            <li>A</li>
                                            <li>B</li>
                                            <li>C</li>
                                        </ol>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <table style="height: 79px;" width="877">
                                <tbody>
                                <tr>
                                <td><strong><?php echo $this->lang->line('COMPROMISOS'); ?>:</strong></td>
                                </tr>
                                <tr>
                                <td>
                                    <ol>
                                        <li>A</li>
                                        <li>B</li>
                                        <li>C</li>
                                    </ol>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </textarea>
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>                 
                    <div class="form-group has-feedback">
                        <div class="col-sm-2 text-right">
                            <label for="tags" class="control-label"><?php echo $this->lang->line('Palabras Clave'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="validate[required] form-control" id="tags" name="tags" placeholder="<?php echo $this->lang->line('Registre las palabras clave separadas por coma'); ?>">
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-2 text-right">
                            <label for="publico" class="control-label"><?php echo $this->lang->line('Documento Publico'); ?>:</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="validate[required] form-control select2-select" id="publico" name="publico">
                                <option value=""><?php echo $this->lang->line('Seleccione...'); ?></option>
                                <option value="NO"><?php echo $this->lang->line('NO'); ?></option>
                                <option value="SI"><?php echo $this->lang->line('SI'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <input type="hidden" name="preli" id="preli" value="0">
                            <a class="btn btn-success" href="#" target="_blank" onclick="preliminar();return false" name="preliminar"><i class="fa fa-fw fa-file-pdf-o"></i><?php echo $this->lang->line('Preliminar'); ?></a>
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check"></i><?php echo $this->lang->line('Guardar'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>