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
                          <h4 class="card-title">Tipo de controle</h4>
                      </div>
                  </div>
                  <div class="card-body">

                      <form  id="delete-form" method="POST"  action="{{ route('controlType.destroy',[ 'controlType' => $controlType->id ])}}" enctype="multipart/form-data" class="col-12 was-validated">
                        @method('DELETE')
                        @csrf
               
                        @include('auxiliaries/controlType/form_show')

                      <button type="submit" class="btn btn-danger">Deletar</button>

                      <a class="btn btn-primary" href="{{route('controlType.edit',[ 'controlType' => $controlType->id ])}}" class="btn btn-danger">editar</a>
 
                      <a class="btn btn-primary" href="{{route('controlType.index')}}" class="btn btn-danger">Voltar</a>

                     
                  </form>
                         
          </div>
      </div>

  
  
  </x-app-layout>