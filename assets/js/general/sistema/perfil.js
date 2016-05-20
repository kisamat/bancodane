/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
	$("#avatar").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		browseLabel: '',
		removeLabel: '',
		browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-avatar-errors',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="'  + baseurl + '/uploads/avatar.png" alt="Your Avatar" style="width:200px">',
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
	
	$('#formFormacion').validationEngine({
		 promptPosition: "bottomLeft",
		 scroll: false,
		 autoHidePrompt: true,
		 autoHideDelay: 3000
     });
     
     
     $('#formFormacion').submit(function () {
		var $resultado = $('#formFormacion').validationEngine("validate");
     });

	$('#formExperiencia').validationEngine({
		 promptPosition: "bottomLeft",
		 scroll: false,
		 autoHidePrompt: true,
		 autoHideDelay: 3000
     });
     
     
     $('#formExperiencia').submit(function () {
		var $resultado = $('#formExperiencia').validationEngine("validate");
     });
	 
	$('#formCargaAvatar').validationEngine({
		 promptPosition: "bottomLeft",
		 scroll: false,
		 autoHidePrompt: true,
		 autoHideDelay: 3000
     });
     
     
     $('#formCargaAvatar').submit(function () {
		var $resultado = $('#formCargaAvatar').validationEngine("validate");
     });
	 
	$('#fechaIng').datepicker({
            format: 'yyyy-mm-dd',
			language: 'es'
        });
		
	$('#fechaRet').datepicker({
            format: 'yyyy-mm-dd',
			language: 'es'
        });	 

	$('#fechaTerm').datepicker({
            format: 'yyyy-mm-dd',
			language: 'es'
        });
		
	$('#fechaTarj').datepicker({
            format: 'yyyy-mm-dd',
			language: 'es'
        });	
		
	
		
	$("#nivel").change(function() {
		$("#nivel option:selected").each(function() {
			nivel = $('#nivel').val();
			areas = $('#areas').val();
			$.post(baseurl+"/inicio/cargaPrograma", {
				nivel : nivel,
				areas : areas
			}, function(data) {
				$("#programa").html(data);
			});
		});
	});	
	
	$("#areas").change(function() {
		$("#areas option:selected").each(function() {
			nivel = $('#nivel').val();
			areas = $('#areas').val();
			$.post(baseurl+"ciudadano/principal/cargaPrograma", {
				nivel : nivel,
				areas : areas
			}, function(data) {
				$("#programa").html(data);
			});
		});
	});	
			
	$("input:radio[name=graduado]").change(function() {
		
		if($('input:radio[name=graduado]:checked').val() == 'S')
			{
				$("#div_valGraduado").css("display", "block");
			}else if($('input:radio[name=graduado]:checked').val() == 'N')
			{
				$("#div_valGraduado").css("display", "none");
			}
	});	
	
	$("#pais").change(function() {
		$("#pais option:selected").each(function() {
			pais = $('#pais').val();
			$.post(baseurl+"ciudadano/principal/cargaDepto", {
				pais : pais
			}, function(data) {
				if(pais != 'COL')
				{
					$("#municipio").html('');
					$("#municipio").removeClass('validate[required]');
					$("#departamento").html('');
					$("#departamento").removeClass('validate[required]');
				}else
				{
					$("#departamento").html(data);
					$("#municipio").addClass('validate[required]');
					$("#departamento").addClass('validate[required]');
				}				
			});
		});
	});	
	
	$("#departamento").change(function() {
		$("#departamento option:selected").each(function() {
			departamento = $('#departamento').val();
			$.post(baseurl+"ciudadano/principal/cargaMuni", {
				departamento : departamento
			}, function(data) {
				$("#municipio").html(data);
			});
		});
	});	
	
	$("input:checkbox[name=fechaAct]").change(function() {

		if($('input:checkbox[name=fechaAct]:checked').val() == 'on')
			{
				$("#fechaRet").removeClass("validate[required]");
			}else 
			{
				$("#fechaRet").addClass("validate[required]");
			}
	});
	
	$("#nivel").change(function() {
		$("#nivel option:selected").each(function() {
			nivel = $('#nivel').val();
			
			if(nivel == 8 || nivel == 9 || nivel == 10)
			{
                            $("#div_valGraduado").css("display", "none");
                            $("#div_graduado").css("display", "none");
			}else if(nivel == 11){
                            $("#div_semestres").css("display", "none");
                            $("#div_graduado").css("display", "none");
                            $("#div_modalidad").css("display", "none");
                            $("#div_areacono").css("display", "none");
                            $("#div_programa").css("display", "none");
                            $("#div_fechatarje").css("display", "none");
                            $("#div_soptarje").css("display", "none");
                        }else{
                            $("#div_valGraduado").css("display", "block");
                            $("#div_graduado").css("display", "block");

                            $("#div_semestres").css("display", "block");
                            $("#div_modalidad").css("display", "block");
                            $("#div_areacono").css("display", "block");
                            $("#div_programa").css("display", "block");
                            $("#div_fechatarje").css("display", "block");
                            $("#div_soptarje").css("display", "block");
			}			
		});
	});	
	
			
	$("input:radio[name=sexo]").change(function() {
		
		if($('input:radio[name=sexo]:checked').val() == 'M')
			{
				$("#div_libreta").css("display", "block");
			}else if($('input:radio[name=sexo]:checked').val() == 'F')
			{
				$("#div_libreta").css("display", "none");
			}
	});
	$("#trabajo").change(function() {
		
		if($('#trabajo').val() == 'S')
		{
                    $("#inf-dane").css("display", "block");
		}else{
                    $("#inf-dane").css("display", "none");
                    $("#inftrabajo-dane").css("display", "none");
                    $("#inftrabajo-nodane").css("display", "none");
                    $("#tipo-empleado").css("display", "none");
                    $("#tipo-indepen").css("display", "none");
		}
	});
        $("#trabajodane").change(function() {
		
		if($('#trabajodane').val() == 'S')
		{
                    $("#inftrabajo-nodane").css("display", "none");
                    $('#inftrabajo-nodane').find('input, textarea, button, select').attr('disabled',true);
                    $("#inftrabajo-dane").css("display", "block");
                    $('#inftrabajo-dane').find('input, textarea, button, select').attr('disabled',false);
                    
		}else{
                    $("#inftrabajo-dane").css("display", "none");
                    $('#inftrabajo-dane').find('input, textarea, button, select').attr('disabled',true);
                    $("#inftrabajo-nodane").css("display", "block");
                    $('#inftrabajo-nodane').find('input, textarea, button, select').attr('disabled',false);
                    
		}
	});
        $("#tipotrabajador").change(function() {
		
		if($('#tipotrabajador').val() == 1)
		{
                    $("#tipo-indepen").css("display", "none");
                    $("#tipo-empleado").css("display", "block");
                    
		}else{
                    $("#tipo-empleado").css("display", "none");
                    $("#tipo-indepen").css("display", "block");
		}
	});
        
        
});
