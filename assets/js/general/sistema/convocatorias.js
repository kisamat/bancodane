/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("select#ciudades").treeMultiselect({sortable: false, collapsible: true, startCollapsed: true});
    $('#formConvocatoria').validationEngine({
        promptPosition: "bottomLeft",
        scroll: false,
        autoHidePrompt: true,
        autoHideDelay: 3000
    });
    $('#formConvocatoria').submit(function () {
        var $resultado = $('#formConvocatoria').validationEngine("validate");
    });
    $('#fechaInicio').datepicker({
        format: 'yyyy-mm-dd',
        language: 'es'
    });
    $('#fechaFin').datepicker({
        format: 'yyyy-mm-dd',
        language: 'es'
    });
    $("select#area").treeMultiselect({
        sortable: false,
        collapsible: true,
        hideSidePanel: true,
        sectionDelimiter: '/',
        startCollapsed: true
    });
    $("#nivel").change(function () {
        $("#nivel option:selected").each(function () {
            nivel = $('#nivel').val();
            $.post(baseurl + "administrador/convocatorias/cargaPrograma", {
                nivel: nivel
            }, function (data) {
                $("#area").html(data);
            });
        });
    });
    
    $("#investigacion").change(function () {
        $("#investigacion option:selected").each(function () {
            
            investigacion = $('#investigacion').val();
            rol = $('#rol').val();
            
            $.post(baseurl + "administrador/convocatorias/cargaInfoPerfil", {
                investigacion: investigacion,
                rol: rol
            }, function (data) {
                $("#perfil").html(data);
            });
            
            
            $.post(baseurl + "administrador/convocatorias/cargaInfoObjeto", {
                investigacion: investigacion,
                rol: rol
            }, function (data) {
                $("#objeto").html(data);
            });
        });
    });

    
    $("#rol").change(function () {
        $("#rol option:selected").each(function () {
            
            investigacion = $('#investigacion').val();
            rol = $('#rol').val();
            
            $.post(baseurl + "administrador/convocatorias/cargaInfoPerfil", {
                investigacion: investigacion,
                rol: rol
            }, function (data) {
                $("#perfil").html(data);
            });
            
            
            $.post(baseurl + "administrador/convocatorias/cargaInfoObjeto", {
                investigacion: investigacion,
                rol: rol
            }, function (data) {
                $("#objeto").html(data);
            });
        });
    });
    
    $('#my-table').DataTable();

});
function ifSelectNotEmpty(field, rules, i, options) {
    if ($(field).find("option").length > 0 &&
            $(field).find("option:selected").length == 0) {
        // this allows the use of i18 for the error msgs
        return "* This field is required";
    }
}
