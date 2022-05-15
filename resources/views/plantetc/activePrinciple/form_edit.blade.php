<div>
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Nome da Cultura</label>
                        <input type="text" name="name" value="{{old('name') ?? $activePrinciple->name }}" class="form-control form-control-sm" placeholder="Variedade">
                        @if($errors->has('name'))
                                <h6 class="text-danger" >Digite a Princípio Ativo</h6> 
                        @endif
                    </div>

                    <div class="form-group"> 
                        <label for="colFormLabelSm" class="form-label">Classe Agronômica</label>
                        <select name="agronomicClass_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                           <option selected disabled value="">Selecione</option>
                           @foreach($agronomicClasses as $agronomicClass)    
                                    <option value="{{$agronomicClass->id}}" {{ $agronomicClass->id ==  $activePrinciple->agronomicClass_id ? 'selected' : ''}}>{{$agronomicClass->name}} </option>                 
                                @endforeach
                        </select> 
                        @if($errors->has('agronomicClass_id'))    
                            <h6 class="text-danger" >Selecione</h6> 
                        @endif 
                     </div>

                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Descrição</label>
                        <input type="text" name="description" value="{{old('description') ?? $activePrinciple->description }}" class="form-control form-control-sm" placeholder="Descrição">
                        @if($errors->has('description'))
                                <h6 class="text-danger" >Digite a descrição</h6> 
                        @endif
                    </div>
                                        
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Nota</label>
                        <input type="text" name="note" value="{{old('note') ?? $activePrinciple->note }}" class="form-control form-control-sm" placeholder="Nota">
                    </div>

                    <div class=row >
                        <div class="col-lg-1">                
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h6 class="card-title">Atual</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div>
                                            <?php $index = 0   ?>    
                                            @foreach($relation_ids as $relation_id)
                                                <?php $index++ ?>                
                                                <div class="col">   
                                                    <div class="form-check form-group"> 
                                                            <input type="radio" class="form-check-input" name="before_id[{{$index}}]" id="validationFormCheck1" 
                                                            {{((($relation_id->id)) == $relation_lists[$index]) ? 'checked': ""}} />
                                                    </div>
                                                </div>                      
                                            @endforeach
                                        </div>
                                    </div>                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-11">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h6 class="card-title">Atualizar - Repita os que permanezem no relacionamento</h6>
                                </div>
                            </div>  
                        <div class="card-body">
                            <div class="user-post-data">
                                <div class="d-flex flex-wrap">
                                    <div class="media-support-info mt-2">
                                        <?php $index = 0   ?>    
                                        @foreach($relation_ids as $relation_id)
                                            <?php $index++   ?> 
                                            <div class="col">   
                                                <div class="form-check form-group">
                                                    <input type="radio" name="after_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                                    <label class="form-check-label" for="after_id[{{$index}}]">{{$relation_id->name}}</label>
                                                </div>
                                            </div>                              
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-check form-group">
                    <input type="radio" name="clear_id" class="form-check-input" id="validationFormCheck1" >
                    <label class="text-danger" for="clear_id">Excluir todos</label>
                </div>
 

                        @if(!Request::is('*/edit'))
                        <input type="hidden" name="in_use" value="S" class="form-control py-3">
                    @else
                        <div class="form-group">
                            <label>Ativo (S/N): {{$activePrinciple->in_use}} </label>
                            <select name="in_use"  id="in_use" class="form-control">
                                <option value="S">Sim</option>
                                <option value="N">Não</option>
                            </select>
                            @if($errors->has('in_use'))
                                <h6 class="text-danger" >Escolha a opção</h6> 
                            @endif
                        </div>
                    @endif

                </div>
            </div>        
        </div>
    </div>
</div> 

