//--------------------------------------Inicio----------------------------------------//
function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("MsxmL2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }
  
  $(document).ready(function() {
    $('#date-hour').load('../php/componentes/menu/date-hour.php');
    $('#actions-lg-scr').load('../php/componentes/menu/actions-lg-scr.php');
    $('#actions-sm-scr').load('../php/componentes/menu/actions-sm-scr.php');
    $('#menu').load('../php/componentes/menu/menu.php');

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });  



});

function cerrar_menu() {
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }

  //---------------------------------------------------------------------------------------//

  function mostrar_tabla(){

    cod_cul = $('#cod_cul').val(); 

    ajax = objetoAjax();
  ajax.open("POST", "../php/componentes/componentes_nutricion/tab_nutricion.php", true);
  ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
          document.getElementById("tab_nutricion").innerHTML = ajax.responseText;
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
      }
  }
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send("cod_cul=" + cod_cul);
  }