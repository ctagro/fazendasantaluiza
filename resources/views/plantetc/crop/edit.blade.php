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
                            <h4 class="card-title">Editar cultura</h4>
                        </div>
                    </div>

                    <div class="card-body">
                
                        <form  action="{{ route('crop.update',[ 'crop' => $crop->id ])}}" method="POST" enctype="multipart/form-data" class="col-12 was-validated">
                            @method('PATCH')
                            @csrf
                 
                            @include('plantetc/crop/form_edit')

                            <button type="submit" class="btn btn-primary">Salvar</button>

                            <a class="btn btn-primary" href="{{route('crop.index')}}" class="btn btn-danger">Voltar</a>

                            <a class="btn btn-danger" href="{{route('crop.create')}}" class="btn btn-danger">Cancelar</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</x-app-layout>

<script src="{{asset('js/select-btn.js') }}"></script>


