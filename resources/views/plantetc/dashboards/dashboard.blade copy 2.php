<x-app-layout>
<div class="row">
  
<?php

$cotacoes = [];
$price_com =[];
$last_cotacoes = [];
$prices_com  = [];
$num_chart = 0;


foreach($products as $product){

$num_chart = $num_chart + 1;

$product_name = $product->name;

$cotacoes = $cotacoes + $last_cotacoes;

   for ($i = 0; $i <= 2; $i++) { 

      $last_date = $last_dates[$i]->date;
      
      $last_cotacoes[$i]= DB::table('price_ceasa_bhs')
                           ->where('product' , $product_name)
                           ->where('date', $last_date)
                           ->get();
                        
                        
      } 
      $cont =-1;

// Ultimas 3 Cotações
   foreach( $last_cotacoes as $last_cotacao){
      $cont = $cont + 1;
      $cotacao = $last_cotacao->toArray();
      $prices_com[$cont] = $cotacao[0]->price_com;
   }
   $var_price = (1-($prices_com[$cont]/$prices_com[$cont-1]))*100;
   $last_price =  $prices_com[$cont];
   $dados_Chart = implode(",",$prices_com);
   $chart_js = "'".'#'.'chart'. strval($num_chart) ."'";
   $call_chart_js = 'chart'. strval($num_chart) ;

 
 //dd($chart_js,$call_chart_js,$dados_Chart,$var_price,$last_price);
?>

<div class="col-lg-4">
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <div class="bg-soft-primary rounded p-3">
               <svg width="24px" height="24px" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M13,2.05C18.05,2.55 22,6.82 22,12C22,13.45 21.68,14.83 21.12,16.07L18.5,14.54C18.82,13.75 19,12.9 19,12C19,8.47 16.39,5.57 13,5.08V2.05M12,19C14.21,19 16.17,18 17.45,16.38L20.05,17.91C18.23,20.39 15.3,22 12,22C6.47,22 2,17.5 2,12C2,6.81 5.94,2.55 11,2.05V5.08C7.61,5.57 5,8.47 5,12A7,7 0 0,0 12,19M12,6A6,6 0 0,1 18,12C18,14.97 15.84,17.44 13,17.92V14.83C14.17,14.42 15,13.31 15,12A3,3 0 0,0 12,9L11.45,9.05L9.91,6.38C10.56,6.13 11.26,6 12,6M6,12C6,10.14 6.85,8.5 8.18,7.38L9.72,10.05C9.27,10.57 9,11.26 9,12C9,13.31 9.83,14.42 11,14.83V17.92C8.16,17.44 6,14.97 6,12Z" />
               </svg>
            </div>
            <div>
               <span>{{$product_name}}</span>
               <span>{{$chart_js}}</span>
               <span>{{$call_chart_js}}</span>
            </div>
         </div>
         <div class="d-flex justify-content-between align-items-center">
            <span>
               <h6 class="counter"><b>{{$last_price}}</b></h6>
            </span>
            <div id={{$call_chart_js}}></div>
            <div class=" d-flex align-items-center text-primary">
               <b>{{$var_price}}</b>
               <svg xmlns="http://www.w3.org/2000/svg"  width="15" height="15"  viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
               </svg>
            </div>
         </div>
      </div>
   </div>
</div>


<?php

}

?>   




</x-app-layout>

<script>

   /*--------------Widget Box----------------*/

(function (jQuery) {
    "use strict";


if(jQuery(<?=$chart_js?>).length){
  var options = {
    series: [{
      name: <?=$chart_js?>,
      data: [<?=$dados_Chart?>]
  }],
    colors: ["#344ed1"],
    chart: {
    height: 50,
    width: 100,
    type: 'line',
    sparkline: {
        enabled: true,
    },
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  title: {
    text: '',
    align: 'left'
  },
  
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar'],
  },
  tooltip:{
    enabled: false,
  }
  };
  var chart = new ApexCharts(document.querySelector(<?=$chart_js?>), options);
  chart.render();
  var body = document.querySelector('body')
  if (body.classList.contains('dark')) {
    apexChartUpdate(chart, {
      dark: true
    })
    
  }
  document.addEventListener('ChangeColorMode', function (e) {
    apexChartUpdate(chart, e.detail)
    
  })

  
  
}

/*--------------Widget Cot1----------------*/


if(jQuery('#iq-chart-cot2').length){
  const options = {
    series: [{
      name: "Total sales",
      data: [5,4,7,8]
  }],
    colors: ["#344ed1"],
    chart: {
    height: 50,
    width: 100,
    type: 'line',
    sparkline: {
        enabled: true,
    },
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  title: {
    text: '',
    align: 'left'
  },
  
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar'],
  },
  tooltip:{
    enabled: false,
  }
  };
  const chart = new ApexCharts(document.querySelector('#iq-chart-cot2'), options);
  chart.render();
  const body = document.querySelector('body')
  if (body.classList.contains('dark')) {
    apexChartUpdate(chart, {
      dark: true
    })
  }
  document.addEventListener('ChangeColorMode', function (e) {
    apexChartUpdate(chart, e.detail)
  })
  
}

})(jQuery)

</script>