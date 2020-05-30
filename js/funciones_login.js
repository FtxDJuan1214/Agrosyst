function recuperar(){
    
    correo=$('#correo').val();
    //alert(correo);
    if(correo != ""){
        cadena = "correo="+correo;

    //alert("cadena "+ cadena);

    $.ajax({
        type:"post",
        url:"php/crud/login/enviar_correo.php",
        data:cadena,
        success:function(r){
          //alert(r);
          if(!(r.includes('NoEsta'))){	
              
            cadena = "correo="+correo+
            "&contra="+r;

            $.ajax({
              type:"post",
              url:"php/crud/login/enviar_not.php",
              data:cadena
              ,
              success:function(e){
                  //alert(e);
                
                }
            });
               
            swal("Se ha enviado una nueva contraseña a tu correo.","Asegurate de revisar también en correos no deseados.", "info");
            setTimeout("window.location.replace('login.php');",5000);               
   
          }else if(r.includes('NoEsta')){

            swal("Este correo no está registrado."," ", "error");
           
          }
        }
      });

        
    }else{
         swal("","Por favor llene el campo", "error");
        
    }
    
    
}    
