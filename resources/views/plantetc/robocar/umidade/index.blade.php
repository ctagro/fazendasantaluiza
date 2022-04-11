<x-app-layout>
    <div class="row  row-cols-1 row-cols-md-2 g-4">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">Umidade do ar</h4>
            </div>
         </div>
         <div class="card-body">
            <p>Entre com a umidade do ar</p>
            <form  action="{{ route('umidade.store') }}" method="POST" enctype="multipart/form-data" class="col-12">
             @method('POST')
             @csrf
        
                    @include('plantetc.robocar.umidade.form')
  
                    <div class="form-group">
                      <div class="form-check">
                         
                      </div>
                    </div>
                    <div class="form-group">
                       <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                 </form>
              </div>
           </div>
      </div>
  
    </x-app-layout>