<?php

$valores = [];

foreach( $umidades as $umidade){
        
        $valores[] = $umidade->valor;
      
       }
      
       $valores_json = json_encode($valores);

     echo($valores_json);

      // dd("parei");

     //  return redirect()->route('umidade.chart');

   //    dd($valores, $valores_json);


?>

<script src="{{asset('js/plantetc/script.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

