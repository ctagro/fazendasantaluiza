<x-app-layout>


<div class="col-md-12 col-lg-8">
  <div class="row">
    <div class="col-md-12">
        <div class="card" data-aos="fade-up" data-aos-delay="800">
            <div class="card-header d-flex justify-content-between flex-wrap">
              <div class="header-title">
                  <h4 class="card-title">Medidas</h4>
                          
              </div>
            </div>
        </div> 
        <div class="card-body">
            <div id="grafico" class="d-main"></div>
        </div>
  </div>
</div>

</x-app-layout>


<script>

  /*--------------Widget Box----------------*/



(function (jQuery) {
    "use strict";
    let dados = [0,0,0,0,0,0,0,0,0,0];
  /*--------------Widget Box----------------*/
console.log(dados);
    if (jQuery('#grafico').length) {
  const options = {
      series: [{
        name: 'medidas',
        data: [0,0,0,0,0,0,0,0,0,0],
      }],

      chart: {
          fontFamily: '"Inter", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
          height: 245,
          type: 'area',
          toolbar: {
              show: false
          },
          sparkline: {
              enabled: false,
          },
      },
      colors: ["#3a57e8", "#4bc7d2", '#aaaaaa'],
      dataLabels: {
          enabled: false
      },
      stroke: {
          curve: 'smooth',
          width: 3,
      },
      animations: {
       enabled: false,
      },
      yaxis: {
        show: true,
        labels: {
          show: true,
          minWidth: 1,
          maxWidth: 20,
          style: {
            colors: "#8A92A6",
          },
          offsetX: 0,
        },
      },
      legend: {
          show: false,
      },
      xaxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            },

      yaxis: {
          min: 0,
          max: 100,
      },
       
      },
      grid: {
          show: false,
      },
      fill: {
          type: 'gradient',
          gradient: {
              shade: 'dark',
              type: "vertical",
              shadeIntensity: 0,
              gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
              inverseColors: true,
              opacityFrom: .4,
              opacityTo: .1,
              stops: [0, 50, 80],
              colors: ["#3a57e8", "#4bc7d2", '#aaaaaa']
          }
      },
      tooltip: {
        enabled: true,
      },
  };

  var chart = new ApexCharts(document.querySelector("#grafico"), options);
  chart.render();
}
 
})(jQuery)
 
</script>


