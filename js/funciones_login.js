function recuperar(){
    
    correo=$('#correo').val();
    cadena = "correo="+correo;

    //alert("cadena "+ cadena);

    $.ajax({
        type:"post",
        url:"php/crud/login/enviar_correo.php",
        data:cadena,
        success:function(r){
            alert(r);
           if(r.includes('1')){	
               
            swal("Se ha enviado una nueva contraseña a tu correo.","Asegurate de revisar también en correos no deseados.", "info");
            setTimeout("window.location.replace('login.php');",2000);               
   
          }else if(r.includes('No')){

            swal("Este correo no está registrado."," ", "error");
           
          }
        }
      });

    
}    
