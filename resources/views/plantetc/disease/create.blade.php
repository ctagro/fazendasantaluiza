
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
                            <h4 class="card-title">Cadastro de doença</h4>
                        </div>
                    </div>

                    <div class="card-body">
                
                        <form  action="{{ route('disease.store') }}" method="POST" enctype="multipart/form-data" class="col-12 was-validated">
                                @method('POST')
                                @csrf
                                
                                @include('plantetc/disease/form')

                                <button type="submit" class="btn btn-primary">Cadastrar</button>

                                <a class="btn btn-primary" href="{{route('disease.index')}}" class="btn btn-danger">Voltar</a>
    
                                <a class="btn btn-danger" href="{{route('disease.create')}}" class="btn btn-danger">Cancelar</a>

                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
</x-app-layout>