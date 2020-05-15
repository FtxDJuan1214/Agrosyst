

<input id="cod_cul_chart" type="text" value="<?php echo $_POST['cod_cul'] ?>" style="display: none">
<input id="nom_cul_chart" type="text" value="<?php echo $_POST['nom_cul'] ?>" style="display: none">

<div class="row" style="margin-top: 30px;" id="div_de_aportes" style="display: none;">
  <div class="col-md-7">
    <div class="nav-wrapper">
      <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
          <a class="nav-link bg-gradient-green mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="color: #fff;"><i class="ni ni ni-chart-pie-35 mr-2"></i>Aportes en grafica</a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-gradient-green mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false" style="color: #fff;"><i class="ni ni-book-bookmark mr-2"></i>Aportes en informe</a>
        </li>
      </ul>
    </div>
    <div class="card shadow">
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
            <div class="card">
              <div class="card-body">
                <!-- Chart -->
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <!-- Chart wrapper -->
                <canvas id="doughnut-chart"  style="display: block; width: 100%; height: 100%;"></canvas>

              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
          <div id="informe_socio">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-5">
  <div class="card">
    <div class="card-header bg-transparent">
      <div class="row align-items-center">
        <div class="col">
          <h6 class="text-uppercase text-muted ls-1 mb-1">Aportes</h6>
          <h5 class="h3 mb-0">Detalle por socio</h5>
        </div>
      </div>
    </div>
    <div class="card-body">
      <!-- Chart -->
      <canvas id="bar-chart-grouped" style="width: 100%; height: 410px; display: block;"></canvas>
        </div>
      </div>
    </div>
  </div>