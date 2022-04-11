<x-app-layout>
    <p> Umidade Chart </p>



    




          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                   <li>
                       
                       
                       
                       
                       <?php

                     // echo($valores_json);
// dd('View chart');
 /*
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
       
        */
 
 //dd($dates,$prices_com,$prices_max,$product,$prices_min);
 
 
     ?>
 
             </div>
          </div> 
          <div class="card-body">
             <div id="grafico" class="d-main"></div>

            
          </div>
       </div>
 
 
 
 
 </x-app-layout>
 

 
 
 