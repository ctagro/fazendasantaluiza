<x-app-layout>

  <br>
  @if(session('sucess'))
      <div class="alert alert-success">
          {{ session('sucess') }}
      </div>
  @endif

  @if(session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
  @endif

  <div class="container">

          @if(Session::has('mensagem_sucesso'))

                  <div class="alert alert-success"> {{ Session::get('mensagem_sucesso')}}</div>

          @endif
  </div>

  <div>
      <div class="row">
          <div class="col">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                          <h4 class="card-title">Fabricante</h4>
                      </div>
                  </div>
                  <div class="card-body">

                      <form  id="delete-form" method="POST"  action="{{ route('manufacturer.destroy',[ 'manufacturer' => $manufacturer->id ])}}" enctype="multipart/form-data" class="col-12 was-validated">
                        @method('DELETE')
                        @csrf
               
                        @include('auxiliaries/manufacturer/form_show')

                      <button type="submit" class="btn btn-danger">Deletar</button>

                      <a class="btn btn-primary" href="{{route('manufacturer.edit',[ 'manufacturer' => $manufacturer->id ])}}" class="btn btn-danger">editar</a>
 
                      <a class="btn btn-primary" href="{{route('manufacturer.index')}}" class="btn btn-danger">Voltar</a>

                     
                  </form>
                         
          </div>
      </div>

  
  
  </x-app-layout>