
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
              <h4 class="card-title">Listagem de Principios Ativos</h4>
              
           </div>
           <a class="float-right btn btn-primary" href="{{route('activePrinciple.create')}}">Cadastrar Principio ATivo</a>
        </div>
        <div class="card-body">

           <div class="table-responsive h6"> <!-- mudei o h6 no hope-ui.css de 1rem para 0.8rem -->
              <table id="datatable" class="table table-striped" data-toggle="data-table">
                 <thead>
                   <tr class="text-sm-left" >
                        <th><small>Nome<small></th> 
                        <th><small>Classe Agonômica<xl-small></th>
                        <th><small>Descrição<xl-small></th>
    
                   </tr>
                 </thead>
                 <tbody>
                  @foreach($activePrinciples as $activePrinciple)
                  <tr class="h6">           
                     <td>  
                        <a href= "{{ route('activePrinciple.show' , $activePrinciple->id  )}}" >{{ $activePrinciple->name}}</a>
                     </td>
                     <td>  
                        <a href= "{{ route('activePrinciple.show' , $activePrinciple->id  )}}" >{{ $activePrinciple->agronomicClass_id}}</a>
                     </td>
                     <td>  
                        <a href= "{{ route('activePrinciple.show' , $activePrinciple->id  )}}" >{{ $activePrinciple->description}}</a>
                     </td>
                  </tr>
                     
                 
                   @endforeach

                 </tbody>
                 <tfoot>
                   <tr class="h6" >
                     <th><small>Nome<xl-small></th>
                     <th><small>Classe Agronômica<xl-small></th>                       
                     <th><small>Descrição<xl-small></th>

                   </tr>
                 </tfoot>
              </table>
           </div>
        </div>
     </div>
  </div>
</div>
</x-app-layout>