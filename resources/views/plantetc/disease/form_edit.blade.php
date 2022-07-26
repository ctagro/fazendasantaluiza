<div>
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Nome da Doença</label>
                        <input type="text" name="name" value="{{old('name') ?? $disease->name }}" class="form-control form-control-sm" placeholder="Variedade">
                        @if($errors->has('name'))
                                <h6 class="text-danger" >Digite a Doença</h6> 
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Nome científico</label>
                        <input type="text" name="scientific_name" value="{{old('scientific_name') ?? $disease->scientific_name }}" class="form-control form-control-sm" placeholder="Descrição">
                        @if($errors->has('scientific_name'))
                                <h6 class="text-danger" >Digite o nome científico</h6> 
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Descrição</label>
                        <input type="text" name="description" value="{{old('description') ?? $disease->description }}" class="form-control form-control-sm" placeholder="Descrição">
                        @if($errors->has('description'))
                                <h6 class="text-danger" >Digite a descrição</h6> 
                        @endif
                    </div> 
                    
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Sintonas e danos</label>
                        <input type="text" name="symptoms" value="{{old('symptoms') ?? $disease->symptoms }}" class="form-control form-control-sm" placeholder="Sintomas">
                        @if($errors->has('symptoms'))
                                <h6 class="text-danger" >Digite os sintomas</h6> 
                        @endif
                    </div>  
                    
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Controles</label>
                        <input type="text" name="control" value="{{old('control') ?? $disease->control }}" class="form-control form-control-sm" placeholder="Controles">
                        @if($errors->has('control'))
                                <h6 class="text-danger" >Digite os controles</h6> 
                        @endif
                    </div>    
            
                        <div class="form-group">
                            <label class="form-label" for="colFormLabelSm">Nota</label>
                            <input type="text" name="note" value="{{old('note') ?? $disease->note }}" class="form-control form-control-sm" placeholder="Nota">
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
                                                                <input type="radio" class="form-check-input" name="before_id[{{$index}}]" value={{$relation_lists[$index]}}id="validationFormCheck1" 
                                                                {{($relation_id == $relation_lists[$index]) ? 'checked': ""}} />
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
                                            @foreach($relation0_ids as $relation0_id)
                                                <?php $index++   ?> 
                                                <div class="col">   
                                                    <div class="form-check form-group">
                                                        <input type="radio" name="after_id[{{$index}}]" value={{$relation0_id->id}} class="form-check-input" id="validationFormCheck1" >
                                                        <label class="form-check-label" for="after_id[{{$index}}]">{{$relation0_id->name}}</label>
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
                    
                    <div class=row >
                        @if(!Request::is('*/edit'))
                            <input type="hidden" name="in_use" value="S" class="form-control form-control-sm py-3">
                        @else
                            <div class="form-group col-sm-3">
                                <label>Ativo: {{$disease->in_use}} </label>
                                <select name="in_use"  id="in_use" class="form-select" required aria-label="select example">>
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
</div> 

