

<input id="cod_cul_chart_pro" type="text" value="<?php echo $_POST['cod_cul'] ?>" style="display: none">
<input id="nom_cul_chart_pro" type="text" value="<?php echo $_POST['nom_cul'] ?>" style="display: none">

<div class="row" style="margin-top: 30px;" id="div_de_aportes" style="display: none;">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
           <h6 class="text-uppercase text-muted ls-1 mb-1">Rendimiento de producción</h6>
           <h5 class="h3 mb-0">Dinero recaudado en el cultivo</h5>
         </div>
       </div>
     </div>
     <div class="card-body">
      <!-- Chart -->
      <canvas id="line-chart-dinero"  style="width: 100%; height: 410px; display: block;"></canvas>
    </div>
    <div class="card-footer">
      <div class="text-center">
        <h2 class="text-success" id="total_dinero">Total de dinero recaudado: $ 0</h2>
      </div>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="card">
    <div class="card-header bg-transparent">
      <div class="row align-items-center">
        <div class="col">
          <h6 class="text-uppercase text-muted ls-1 mb-1">Rendimiento de producción</h6>
          <h5 class="h3 mb-0">Kilogramos de tomate recolectados en el cultivo</h5>
        </div>
      </div>
    </div>
    <div class="card-body">
      <!-- Chart -->
      <canvas id="line-chart-kg"  style="width: 100%; height: 410px; display: block;"></canvas>
    </div>
    <div class="card-footer">
      <div class="text-center">
        <h2 class="text-success" id="total_kilos">Total de kilogramos recolectados: 0 Kg</h2>
      </div>
    </div>
  </div>
</div>
</div>


<div class="row" style="margin-top: 30px;"style="display: none;">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Situación actual en el cultivo</h6>
            <h5 class="h3 mb-0">Inversión versus Recaudo</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="bar-chart-horizontal" style="width: 100%; height: 260px; display: block;"></canvas>
        

        <div class="card-body" id="car_ganando" style="margin-top: 10px;">

          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">En ganancias</h5>
              <span class="h2 font-weight-bold mb-0" ></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                <i class="ni ni-money-coins"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2" id="diferencai_gan"> <i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap">Dinero libre que representa ganancias</span>
          </p>

        </div>

        <div class="card-body" id="car_perdiendo" style="margin-top: 10px;">

          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">En perdidas</h5>
              <span class="h2 font-weight-bold mb-0"></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                <i class="ni ni-money-coins"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-danger mr-2" id="diferencai_per"><i class="fa fa-arrow-down"></i></span>
            <span class="text-nowrap">Dinero que representa deudas</span>
          </p>

        </div>

      </div>
    </div>
  </div>

  <div class="col-md-7">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Rendimiento de tipos producción en el cultivo</h6>
            <h5 class="h3 mb-0">Kilogramos de tomate recolectados por tipo de producción</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Chart -->
        <canvas id="pie-chart" style="width: 100%; height: 410px; display: block;"></canvas>
      </div>
    </div>
  </div>
</div>