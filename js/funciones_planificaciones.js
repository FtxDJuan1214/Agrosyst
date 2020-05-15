
  
  //------------------------------------------------------------------------------------------------------------------------------//
  $(document).ready(function() {
  
    jQuery('#ver2').hide();
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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
  
  });
  
  function cerrar_menu() {
    $('#sidenav-main').remove();
    jQuery('#ver1').hide();
    jQuery('#ver2').show();
  }