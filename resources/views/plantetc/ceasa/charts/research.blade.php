

<x-app-layout>
  <div class="row  row-cols-1 row-cols-md-2 g-4">
    <div class="card">
       <div class="card-header d-flex justify-content-between">
          <div class="header-title">
             <h4 class="card-title">Gráfico de preços por produto</h4>
          </div>
       </div>
       <div class="card-body">
          <p>Digite os dados da pesquisa</p>
          <form  action="{{ route('ceasa_charts_research.research') }}" method="POST" enctype="multipart/form-data" class="col-12">
           @method('POST')
           @csrf
      
                  @include('plantetc.ceasa.charts.form_product')

                  <div class="form-group">
                    <div class="form-check">
                       
                    </div>
                  </div>
                  <div class="form-group">
                     <button class="btn btn-primary" type="submit">Executar pesquisa</button>
                  </div>
               </form>
            </div>
         </div>
    </div>

  </x-app-layout>