<div class="d-none d-sm-none d-md-block">
  <div class="">
    <span style="font-size: 1.3rem; color: #fff;"><i class="fa fa-calendar" aria-hidden="true"></i>
      <!-- &nbsp; -->
      <span id="diaSemana" ></span>
      <!-- &nbsp; -->
      <span id="dia" ></span>
      <!-- &nbsp; -->
      <span>de</span>
      <!-- &nbsp; -->
      <span id="mes" ></span>
      <!-- &nbsp; -->
      <span>del</span>
      <!-- &nbsp; -->
      <span id="anio" ></span>
      <br>
      <i class="fa fa-clock"></i>
      <!-- &nbsp; -->
      <span id="horasx" ></span>
      <!-- &nbsp; -->
      <span>:</span>
      <!-- &nbsp; -->
      <span id="minutos" ></span>
      <!-- &nbsp; -->
      <span>:</span>
      <!-- &nbsp; -->
      <span id="segundos" ></span>
      <!-- &nbsp; -->
      <span id="ampm" ></span>
    </span>
  </div>

</div>


<script type="text/javascript">
  $(function(){
    var actualizarHora = function(){
      var fecha = new Date(),
      hora = fecha.getHours(),
      minutos = fecha.getMinutes(),
      segundos = fecha.getSeconds(),
      diaSemana = fecha.getDay(),
      dia = fecha.getDate(),
      mes = fecha.getMonth(),
      anio = fecha.getFullYear(),
      ampm;

      var $spanHorasx = $("#horasx"),
      $pSegundos = $("#segundos"),
      $pMinutos = $("#minutos"),
      $pAMPM = $("#ampm"),
      $pDiaSemana = $("#diaSemana"),
      $pDia = $("#dia"),
      $pMes = $("#mes"),
      $pAnio = $("#anio");
      var semana = ['Domingo ','Lunes ','Martes ','Miercoles ','Jueves ','Viernes ','Sabado '];
      var meses = ['Enero ','Febrero ','Marzo ','Abril ','Mayo ','Junio ','Julio ','Agosto ','Septiembre ','Octubre ','Noviembre ','Diciembre '];

      $pDiaSemana.text(semana[diaSemana]);
      $pDia.text(dia);
      $pMes.text(meses[mes]);
      $pAnio.text(anio);
      if(hora>=12){
        hora = hora - 12;
        ampm = " PM";
      }else{
        ampm = " AM";
      }
      if(hora == 0){
        hora = 12;
      }
      if(hora<10){$spanHorasx.text("0"+hora)}else{$spanHorasx.text(hora)};
      if(minutos<10){$pMinutos.text("0"+minutos)}else{$pMinutos.text(minutos)};
      if(segundos<10){$pSegundos.text("0"+segundos)}else{$pSegundos.text(segundos)};
      $pAMPM.text(ampm);

    };


    actualizarHora();
    var intervalo = setInterval(actualizarHora,1000);
  });
</script>