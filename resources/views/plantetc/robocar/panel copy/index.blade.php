<x-app-layout>
    <div class="row  row-cols-1 row-cols-md-2 g-4">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">Painel</h4>
            </div>
         </div>
         <div class="card-body">
            
        
                    @include('plantetc.robocar.panel.chart')
  
              </div>
           </div>
      </div>
  
    </x-app-layout>