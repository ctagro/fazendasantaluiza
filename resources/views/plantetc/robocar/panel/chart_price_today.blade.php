
<x-app-layout>


   <!--            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                  <li><?php

      $dates = [];
      $prices_com = [];
      $prices_max = [];
      $prices_min = [];
     

       foreach( $cotacoes as $cotacao){
        $dates[] = "'{$cotacao->date}'";
        $prices_com[] = $cotacao->price_com;
        $prices_max[] = $cotacao->price_max;
        $prices_min[] = $cotacao->price_min;
        $product = $cotacao->product;
        $unidade = $cotacao->embalagem;
      
       }

       $ultima_data = max($dates);

// transformando o arry data em uma string de datas

       $dates = implode(",",$dates);
       $prices_com = implode(",",$prices_com);
       $prices_max = implode(",",$prices_max);
       $prices_min = implode(",",$prices_min);
      
       

//dd($dates,$prices_com,$prices_max,$product,$prices_min);


    ?>

<div class="row">
   <div class="col-md-12">
      <div class="card" data-aos="fade-up" data-aos-delay="800">
         <div class="card-header d-flex justify-content-between flex-wrap">
            <div class="header-title">
               <h4 class="card-title"><?=$product?> (<?=$unidade?>)(<?=$ultima_data?>)</h4>
               <p class="mb-0">Variação dos preços no Ceasa BH</p>          
            </div>
            <div class="d-flex align-items-center align-self-center">
               <div class="d-flex align-items-center text-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                     <g id="Solid dot2">
                        <circle id="Ellipse 65" cx="12" cy="12" r="8" fill="currentColor"></circle>
                     </g>
                  </svg>
                  <div class="ms-2">
                     <span class="text-secondary">Preço comum</span>
                  </div>
               </div>
               <div class="d-flex align-items-center ms-3 text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                     <g id="Solid dot3">
                        <circle id="Ellipse 66" cx="12" cy="12" r="8" fill="currentColor"></circle>
                     </g>
                  </svg>
                  <div class="ms-2">
                     <span class="text-secondary">Preço Máximo</span>
                  </div>
               </div>
               <div class="d-flex align-items-center ms-3 text-info">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                     <g id="Solid dot3">
                        <circle id="Ellipse 67" cx="12" cy="12" r="8" fill="currentColor"></circle>
                     </g>
                  </svg>
                  <div class="ms-2">
                     <span class="text-secondary">Preço Mínimo</span>
                  </div>
               </div>
            </div>
            <div class="dropdown">
               <a href="#" class="text-secondary dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                  --
               </a><a class="dropdown-item" href="#">This Week</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
               </ul>
               -->
            </div>
         </div> 
         <div class="card-body">
            <div id="grafico" class="d-main"></div>
         </div>
      </div>



</x-app-layout>

<script>

(function (jQuery) {
    "use strict";

    if (jQuery('#grafico').length) {
  const options = {
      series: [{
          name: 'Preço Comum',
          data: [<?=$prices_com?>]
         }, {
          name: 'Preço Máximo',
          data: [<?=$prices_max?>]
         }, {
          name: 'Preço Mínimo',
          data: [<?=$prices_min?>]
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
          labels: {
              minHeight:22,
              maxHeight:22,
              show: true,
              style: {
                colors: "#8A92A6",
              },
          },
          lines: {
              show: false  //or just here to disable only x axis grids
          },
          categories: [<?=$dates?>]
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


