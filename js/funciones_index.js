function preloader_d(){
	jQuery('#preloaderd').show();
	jQuery('#form-add-ter').hide();
	ide_ter=$('#cod_log').val()+$('#ide_ter').val();
	pno_ter=$('#pno_ter').val();
	sno_ter=$('#sno_ter').val();
	pap_ter=$('#pap_ter').val();
	sap_ter=$('#sap_ter').val();
	tel_ter=$('#tel_ter').val();
	eml_ter=$('#eml_ter').val();
	tipo_per=1;
	setTimeout ("agregar_tercero(ide_ter,pno_ter,sno_ter,pap_ter,sap_ter,tel_ter,eml_ter,tipo_per);", 1000);
}

function agregar_tercero(ide_ter,pno_ter,sno_ter,pap_ter,sap_ter,tel_ter,eml_ter,tipo_per){
	if(ide_ter!=""){
		cadena ="ide_ter="+ide_ter+
		"&pno_ter="+pno_ter+
		"&sno_ter="+sno_ter+
		"&pap_ter="+pap_ter+
		"&sap_ter="+sap_ter+
		"&tel_ter="+tel_ter+
		"&eml_ter="+eml_ter+
		"&tipo_per="+tipo_per;
		$.ajax({
			type:"post",
			data:cadena,
			url:"php/crud/terceros/agregar_tercero.php",
			success:function(r){
				$('#rr').val(r);
				result=$('#rr').val();
				if(result=='Resource id #6'){

					swal("Tercero agregado!"," ", "success");


					var form = document.querySelector('#form-add-ter');
					form.reset();

					jQuery('#preloader').hide();
					jQuery('#form-add-ter').show();
					$('#form-add-ter').modal('show');
					$('#modal-form').modal('hide');
				 $('#dueños').load('php/componentes/componentes_index/duenios.php');
				// Insertar el telefono del tercero

				if(tel_ter==null||tel_ter==" "||tel_ter==""||tel_ter==''){}else{
					$.ajax({
						type:"post",
						url:"php/crud/terceros/agregar_telefono.php",
						data:cadena,
					});
				}

     			// Insertar el Email del tercero

     			if(eml_ter==null||eml_ter==" "||eml_ter==""||eml_ter==''){}else{ 	
     				$.ajax({
     					type:"post",
     					url:"php/crud/terceros/agregar_email.php",
     					data:cadena,
     				});
     			}
     			// // Insertar el tipo de tercero del tercero
     			$.ajax({
     				type:"post",
     				url:"php/crud/terceros/agregar_tipo_per.php",
     				data:cadena,
     				success:function(r){
     					// alert(r);
     					$('#dueños').load('php/componentes/componentes_index/duenios.php');
     				}
     			});
     			$('#dueños').load('php/componentes/componentes_index/duenios.php');
     			$('#modal-dueño').modal('hide');


     		}else{
     			swal("Verifica los datos!", r , "error");
     			jQuery('#preloaderd').hide();
     			jQuery('#form-add-ter').show();
     		}
     	}

     });
	}else{
		jQuery('#preloaderd').hide();
		jQuery('#form-add-ter').show();
		$('#modal-dueño').modal('hide');

	}
}