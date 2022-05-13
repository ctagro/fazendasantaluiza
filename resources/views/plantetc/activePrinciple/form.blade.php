
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body">

                            <input type="hidden" name="in_use" value={{"S"}} class="form-control form-control-sm py-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control form-control-sm py-3">
                    
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nome da Principio Ativo</label>
                                <input type="text" name="name" value="{{old('name') ?? $activePrinciple->name }}" class="form-control form-control-sm" placeholder="Princípio Ativo">
                                @if($errors->has('name'))
                                        <h6 class="text-danger" >Digite o Princípio Ativo</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Classe agronômica</label>
                                <input type="text" name="agronomicClass_id" value="{{old('agronomicClass_id') ?? $activePrinciple->agronomicClass_id }}" class="form-control form-control-sm" placeholder="Classe agronômica">
                                @if($errors->has('agronomicClass_id'))
                                        <h6 class="text-danger" >Digite a Classe agronômica</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Descrição</label>
                                <input type="text" name="description" value="{{old('description') ?? $activePrinciple->description }}" class="form-control form-control-sm" placeholder="Descrição">
                                @if($errors->has('description'))
                                        <h6 class="text-danger" >Digite a descrição</h6> 
                                @endif
                            </div>                        

                            <label class="form-label" for="name">Selecione os pesticides relacionadas:</label>
                            <div class="row">
                                <?php $index = 0   ?> 
                                @foreach($pesticides as $pesticide)
                                    <?php $index++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="pesticide_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="pesticide_id[{{$index}}]">{{$pesticide->name}}</label>
                                            <div class="invalid-feedback">Example invalid feedback text</div>  
                                        </div>
                                    </div>
                                             
                                 @endforeach
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nota</label>
                                <input type="text" name="note" value="{{old('note') ?? $activePrinciple->note }}" class="form-control form-control-sm" placeholder="Nota">
                            </div>

                    </div>
                </div>        
            </div>
        </div>
    </div>        