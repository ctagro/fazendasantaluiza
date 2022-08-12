
    <div> 
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body">

                            <input type="hidden" name="in_use" value={{"S"}} class="form-control form-control-sm py-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control form-control-sm py-3">
                       
                    
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nome da doenças</label>
                                <input type="text" name="name" value="{{old('name') ?? $disease->name }}" class="form-control form-control-sm" placeholder="Doença">
                                @if($errors->has('name'))
                                        <h6 class="text-danger" >Digite a Cultura</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nome científico</label>
                                <input type="text" name="scientific_name" value="{{old('scientific_name') ?? $disease->scientific_name }}" class="form-control form-control-sm" placeholder="Nome Científico">
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
                            
                            <div class="form-group col-sm-6"> 
                                <label for="colFormLabelSm" class="form-label">Tipo de controle</label>
                                <select name="controlType_id" class="form-select form-select-sm mb-3" id="controlType_id" aria-label=".form-select-lg example" required>
                                   <option selected disabled value="">Selecione a Tipo de controle</option>
                                   @foreach($controlTypes as $controlType)    
                                            <option value="{{$controlType->id}}">{{$controlType->name}} </option>                  
                                        @endforeach
                                </select> 
                                @if($errors->has('controlType_id'))    
                                    <h6 class="text-danger" >Selecione</h6> 
                                @endif 
                             </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Informações sobre o controle</label>
                                <input type="text" name="control" value="{{old('control') ?? $disease->control }}" class="form-control form-control-sm" placeholder="Controles">
                                @if($errors->has('control'))
                                        <h6 class="text-danger" >Digite os controles</h6> 
                                @endif
                            </div>    
        

                            <label class="form-label" for="name">Selecione os principios ativos relacionadas:</label>
                            <div class="row">
                                <?php $index = 0   ?> 
                                @foreach($active_principles as $active_principle)
                                    <?php $index++   ?> 
                                    <div class="col-6">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="active_principle_id[{{$index}}]" value={{$active_principle->id}} class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="active_principle_id[{{$index}}]">{{$active_principle->name}}</label>
                                            <div class="invalid-feedback">Example invalid feedback text</div>  
                                        </div>
                                    </div>
                                             
                                 @endforeach
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nota</label>
                                <input type="text" name="note" value="{{old('note') ?? $disease->note }}" class="form-control form-control-sm" placeholder="Nota">
                            </div>

                    </div>
                </div>        
            </div>
        </div>
    </div>        