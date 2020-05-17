<?php
require '../../conexion.php';

session_start();  
$like = $_SESSION['idusuario'];
?>

<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
      <a href="#" onclick="ver_duenios();">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Dueños</h5>
            <span class="h2 font-weight-bold mb-0">
              <?php 
              $sql="SELECT count(ide_ter) FROM duenio where ide_ter like '$like%'";
              $result=pg_query($conexion,$sql);
              $ver=pg_fetch_row($result);
              echo $ver[0];
              ?>
            </span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
              <i class="ni ni-single-02"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
     <a href="#" onclick="ver_socios();">
      <div class="row">
        <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">Socios</h5>
          <span class="h2 font-weight-bold mb-0">
           <?php 
           $sql="SELECT count(ide_ter) FROM socio where ide_ter like '$like%'";
           $result=pg_query($conexion,$sql);
           $ver=pg_fetch_row($result);
           echo $ver[0];
           ?>
         </span>
       </div>
       <div class="col-auto">
        <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
          <i class="ni ni-single-02"></i>
        </div>
      </div>
    </div>
  </a>
</div>
</div>
</div>
<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
      <a href="#" onclick="ver_trabajador();">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Trabajadores</h5>
            <span class="h2 font-weight-bold mb-0">
             <?php 
             $sql="SELECT count(ide_ter) FROM trabajador where ide_ter like '$like%'";
             $result=pg_query($conexion,$sql);
             $ver=pg_fetch_row($result);
             echo $ver[0];
             ?>
           </span>
         </div>
         <div class="col-auto">
          <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
            <i class="ni ni-single-02"></i>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
</div>
<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
     <a href="#" onclick="ver_proveedor();">
      <div class="row">
        <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">Proveedores</h5>
          <span class="h2 font-weight-bold mb-0">
           <?php 
           $sql="SELECT count(ide_ter) FROM proveedor where ide_ter like '$like%'";
           $result=pg_query($conexion,$sql);
           $ver=pg_fetch_row($result);
           echo $ver[0];
           ?>
         </span>
       </div>
       <div class="col-auto">
        <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
          <i class="ni ni-single-02"></i>
        </div>
      </div>
    </div>
  </a>
  </div>
</div>
</div>

<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
     <a href="#" onclick="ver_cliente();">
      <div class="row">
        <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">Clientes</h5>
          <span class="h2 font-weight-bold mb-0">
           <?php 
           $sql="SELECT count(ide_ter) FROM cliente where ide_ter like '$like%'";
           $result=pg_query($conexion,$sql);
           $ver=pg_fetch_row($result);
           echo $ver[0];
           ?>
         </span>
       </div>
       <div class="col-auto">
        <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
          <i class="ni ni-single-02"></i>
        </div>
      </div>
    </div>
  </a>
  </div>
</div>
</div>

<div class="col-sm-4" style="margin-top: 10px;">
  <div class="card card-stats ">
    <div class="card-body">
     <a href="#" onclick="ver_todos();">
      <div class="row">
        <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">Todos</h5>
          <span class="h2 font-weight-bold mb-0">
           <?php 
           $sql="SELECT count(ide_ter) FROM terceros where ide_ter like '$like%'";
           $result=pg_query($conexion,$sql);
           $ver=pg_fetch_row($result);
           echo $ver[0];
           ?>
         </span>
       </div>
       <div class="col-auto">
        <div class="icon icon-shape bg-gradient-warning  text-white rounded-circle shadow">
          <i class="ni ni-single-02"></i>
        </div>
      </div>
    </div>
  </a>
  </div>
</div>
</div>


<script>
  function buscador(){
    var value = $('#myInput').val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  }

  function ver_duenios(){
    $('#myInput').val('Dueño');
    buscador();
  }

  function ver_socios(){
    $('#myInput').val('Socio');
    buscador();
  }

  function ver_trabajador(){
    $('#myInput').val('Trabajador');
    buscador();
  }

  function ver_proveedor(){
    $('#myInput').val('Proveedor');
    buscador();
  }

  function ver_cliente(){
    $('#myInput').val('Cliente');
    buscador();
  }

   function ver_todos(){
    $('#myInput').val('');
    buscador();
  }

</script>