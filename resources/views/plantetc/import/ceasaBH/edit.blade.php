<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividades</title>
     <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    
</body>
</html>

@section('title', 'Editar')

    @extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/activity_plant.jpeg')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                        Atividade
                        <a class="float-right" href="{{ url('/activity') }}">Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <div class="row justify-content-center">
    <div class="col-12">

    <!-- porque nao suporta o metodo POST se store é post-->
        <form action="{{ route('activity.update' ,[ 'activity' => $activity->id,'account' => $activity->account->id])}}" method="POST"  enctype="multipart/form-data">

            @method('PATCH')
            @include('activity.activity.form')

        </form>

        <form action="{{ route('activity.show' ,[ 'activity' => $activity->id,'account' => $activity->account->id ])}}" method="POST"  enctype="multipart/form-data">

            @method('POST')
          
                 <div class="form-group">
                 {!! csrf_field() !!}                      
          
                     <div class="form-group">
                          <button type="submit" class="btn btn-outline-danger" >Deletar...</button>
                     </div>
                 </div>
             </form>
          
    </div>
</div>
</div>

@endsection

