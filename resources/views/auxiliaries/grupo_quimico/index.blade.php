
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

    
<div class="row">
  <div class="col-sm-12">
     <div class="card">
        <div class="card-header d-flex justify-content-between">
           <div class="header-title">
              <h4 class="card-title">Grupo Químicos</h4>
              
           </div>
           <a class="float-right" href="{{url('grupo_quimico/create')}}">Cadastrar</a>
        </div>
        <div class="card-body">

           <div class="table-responsive h6"> <!-- mudei o h6 no hope-ui.css de 1rem para 0.8rem -->
              <table id="datatable" class="table table-striped" data-toggle="data-table">
                 <thead>
                   <tr class="text-sm-left" >
                     <th><small>Nome<xl-small></th>
                     <th><small>Descriçao<xl-small></th>
                     <th><small>Nota<xl-small></th>
 
                    </tr>
                 </thead>
                 <tbody>
                  @foreach($grupo_quimicos as $grupo_quimico)
                  <tr class="h6">
                      <td>  
                      <a href= "{{ route('grupo_quimico.show' ,[ 'grupo_quimico' => $grupo_quimico->id  ])}}" >{{ $grupo_quimico->name}}</a>
                      </td>
                      <td>  
                        <a href= "{{ route('grupo_quimico.show' ,[ 'grupo_quimico' => $grupo_quimico->id  ])}}" >{{ $grupo_quimico->description}}</a>
                        </td>
                      <td>  
                        <a href= "{{ route('grupo_quimico.show' ,[ 'grupo_quimico' => $grupo_quimico->id  ])}}" >{{ $grupo_quimico->note}}</a>
                      </td> 
 
                </tr>
                     
                 
                   @endforeach

                 </tbody>
                 <tfoot>
                   <tr class="h6" >
                     <th><small>Nome<xl-small></th>
                     <th><small>Descriçao<xl-small></th>
                     <th><small>Nota<xl-small></th>


                   </tr>
                 </tfoot>
              </table>
           </div>
        </div>
     </div>
  </div>
</div>
</x-app-layout>