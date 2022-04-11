<x-app-layout>
  <div class="row">
     <div class="col-sm-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                 <h4 class="card-title">Resultado da pesquisa</h4>
              </div>
           </div>
           <div class="card-body">
              <p>Lista de preços pesquisados</p>
              <div class="table-responsive h6"> <!-- mudei o h6 no hope-ui.css de 1rem para 0.8rem -->
                 <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr class="text-sm-left" >
                          <th><small>Data<small></th> 
                          <th><small>Produto<small></th>
                          <th><small>Emb<small></th>
                          <th><small>Pr min<small></th>
                          <th><small>Pr com<small></th>
                          <th><small>Pr max<small></th>
                          <th><small>Status<small></th>
                       </tr>
                    </thead>
                    <tbody>
                     @foreach($cotacoes as $cotacao)
                     <tr class="h6">
                      <th><small>{{ $cotacao->date }}<small></th>
                      <th><small>{{ $cotacao->product}}<small></th>
                      <th><small> {{ $cotacao->embalagem}}<small></th>
                      <th><small>{{ number_format($cotacao->price_min, 2 , ',', '.')  }}<small></th>
                      <th><small>{{ number_format($cotacao->price_com, 2 , ',', '.')  }}<small></th>
                      <th><small>{{ number_format($cotacao->price_max, 2 , ',', '.')  }}<small></th>
                      <th><small>{{ $cotacao->situation}}<small></th>
                   </tr>
                        
                    
                      @endforeach
  
                    </tbody>
                    <tfoot>
                      <tr class="h6" >
                        <th><small>Data<xl-small></th>
                        <th><small>Produto<small></th>
                        <th><small>Embalagem<small></th>
                        <th><small>Preço min<small></th>
                        <th><small>Preço com<small></th>
                        <th><small>Preço max<small></th>
                        <th><small>Situação<small></th>
                      </tr>
                    </tfoot>
                 </table>
              </div>
           </div>
        </div>
     </div>
  </div>
  </x-app-layout>
  