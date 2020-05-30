function preloader(){

    nic_usu=$('#nic_usu').val();
    ema_usu=$('#ema_usu').val();
    usu_usu=$('#usu_usu').val();
    pas_usu=$('#pas_usu').val();
    expresion= /\w+@\w+\.+[a-z]/;
    /*exp_pass=/(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{12,}/;*/


    if(nic_usu=="" || ema_usu=="" || usu_usu=="" || pas_usu==""){
        toastr.error('Todos los campos son obligatorios','',{
			"positionClass": "toast-top-center",
			"closeButton": true,
			"progressBar":true
		});

    }else{
        con_ema_usu= Boolean(false);
        if(ema_usu != ""){
			if (!expresion.test(ema_usu)) {
				$('#div_ema_usu').removeClass("input-group input-group-alternative");
				toastr.error('El correo no es válido','',{
					"positionClass": "toast-top-center",
					"closeButton": true,
					"progressBar":true
				});

			}else{
				con_ema_usu =  Boolean(true);
			}
		}else{
			con_ema_usu =  Boolean(true);
        }
        if(con_ema_usu == true){
            jQuery('#preloader').show();
			jQuery('#form-add-usu').hide();

			setTimeout ("agregar_usuario(nic_usu, ema_usu, usu_usu, pas_usu);", 1000);	
        }

    }

}


function agregar_usuario(nic_usu, ema_usu, usu_usu, pas_usu){

    mensaje="Bienvenido a Agrosyst Co, su usuario ya fue registrado y está listo para trabajar";
    title = 'Bienvenido a Agrosyst Co';
    cadena="&nic_usu="+ nic_usu +
    "&ema_usu="+ ema_usu +
    "&usu_usu="+ usu_usu +
    "&pas_usu="+ pas_usu + 
    "&mensaje="+ mensaje + 
    "&title=" + title;
    $.ajax({
		type:"post",
		data:cadena,
		url:"php/crud/usuarios/agregar_usuario.php",
		success:function(r){

			if(r.includes('Resource id')){
				jQuery('#preloader').hide();
				jQuery('#form-add-usu').show();
                swal('Usuario agregado!',' ', 'success');
                setTimeout ("location.reload();", 1500);
                $.ajax({
                    type: "post",
                    data: cadena,
                    url:"php/crud/usuarios/enviar_correo.php",
                    
                    
                });

                $.ajax({
                    type: "post",
                    data: "usuario="+usu_usu+"&contraseña="+pas_usu,
                    url:"php/logueo.php",
                    
                });
			}else{
				swal("Verifica los datos!", r , "error");
				jQuery('#preloader').hide();
				jQuery('#form-add-usu').show();
			}
		}

	}); 

}

$(function(){
    mayus = /^(?=.*[A-Z])/;
    special = /^(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:"'<>,./?])/;
    numbers = /^(?=.*[0-9])/;
    minus = /^(?=.*[a-z])/;
    lon = /^(?=.{12,})/;
    space = /^\S*$/;
    regExp = [mayus, special, numbers, minus, lon, space];
    elements = [$("#mayus"), $("#special"), $("#numbers"), $("#minus"),$("#lon"),$("#space")];
    con_pas = Boolean(false);
    con_conf = Boolean(false);
    $("#pas_ok").hide();
    $("#save").hide();
    $("#div_conf_pas_usu").hide();
    $("#pas_usu").keyup(function(){
        pass= $("#pas_usu").val();
        
        cont=0;
        for(i=0; i<6;i++){
            if(regExp[i].test(pass)){
                elements[i].hide();
                cont++;
            }else{
                elements[i].show();
                cont=cont-1;
            }            
        }
        
            if(cont==6){
                $("#req_pas").hide();
                $("#pas_ok").show();  
                $("#div_conf_pas_usu").show();               
            }else{
                $("#req_pas").show();
                $("#pas_ok").hide();
                $("#div_conf_pas_usu").hide();
                $("#save").hide();
            } 
        cont=0; 
    });

    $("#conf_pass").keyup(function(){
        pass=$("#pas_usu").val();
        conf=$("#conf_pass").val();
        
        if(pass!=conf){
            $("#req_conf").show();
            $("#save").hide();
        }else{
            $("#req_conf").hide();
            $("#save").show();
            
        }

    });
    

});


