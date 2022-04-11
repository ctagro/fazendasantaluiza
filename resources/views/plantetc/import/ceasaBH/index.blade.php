<x-app-layout>
  <div class="row">
     <div class="col-sm-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                 <h4 class="card-title">Lista de preços baixado</h4>
              </div>
           </div>
           <div class="card-body">
              <p>Registros do arquivo baixado</p>
              <div class="table-responsive">
                 <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                          <th>Data</th> 
                          <th>Produto</th>
                          <th >Embalagem</th>
                          <th >Preço min</th>
                          <th >Preço com</th>
                          <th >Preço max</th>
                          <th >Situação</th>
                       </tr>
                    </thead>
                    <tbody>
                     @foreach($cotacoes as $cotacao)
                     <tr>
                      <th>{{ $cotacao->date }}</th>
                      <th >{{ $cotacao->product}}</th>
                      <th > {{ $cotacao->embalagem}}</th>
                      <th >{{ number_format($cotacao->price_min, 2 , ',', '.')  }}</th>
                      <th >{{ number_format($cotacao->price_com, 2 , ',', '.')  }}</th>
                      <th >{{ number_format($cotacao->price_max, 2 , ',', '.')  }}</th>
                      <th>{{ $cotacao->situation}}</th>
                   </tr>
                        
                    
                      @endforeach
  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Data</th>
                        <th>Produto</th>
                        <th >Embalagem</th>
                        <th >Preço min</th>
                        <th >Preço com</th>
                        <th >Preço max</th>
                        <th >Situação</th>
                      </tr>
                    </tfoot>
                 </table>
              </div>
           </div>
        </div>
     </div>
  </div>
  </x-app-layout>
  