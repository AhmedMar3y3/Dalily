@extends('layout')
@section('main')

<div class="row">
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h3>Users</h3>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">{{ $users }}</h2>
            </div>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg fa fa-users text-primary ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h3>Places</h3>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">{{ $places }}</h2>
            </div>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg fa fa-building text-danger ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h3>Reviews</h3>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">{{ $reviews }}</h2>
            </div>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg fa fa-star-half-empty text-success ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- New Users Chart Section -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">New Users <span>| Last 7 days</span></h3>
      <div id="newUsersChart"></div>
      <script>
     document.addEventListener("DOMContentLoaded", () => {
    const last7Days = @json(array_keys($last7DaysUsers->toArray()));
    const dailyUsers = @json(array_values($last7DaysUsers->toArray()));

    new ApexCharts(document.querySelector("#newUsersChart"), {
        series: [{ name: 'New Users', data: dailyUsers }],
        chart: { height: 350, type: 'area', toolbar: { show: false } },
        markers: { size: 4 },
        colors: ['black'],
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.4,
                stops: [0, 90, 100]
            }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: { type: 'datetime', categories: last7Days },
        yaxis: {
            labels: {
                formatter: function (val) { return Math.round(val) + " User"; }
            },
            min: 0,
            forceNiceScale: true
        },
        tooltip: {
            x: { format: 'dd/MM/yy' },
            theme: 'dark',
            style: {
                fontSize: '12px',
                fontFamily: 'Arial, sans-serif',
                color: '#000000'
            }
        }
    }).render();
});

      </script>
    </div>
  </div>
</div>

@endsection
