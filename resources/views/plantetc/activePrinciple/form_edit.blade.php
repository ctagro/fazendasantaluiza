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
                        <label class="form-label" for="colFormLabelSm">Classe Agronômica</label>
                        <input type="text" name="agronomicClass_id" value="{{old('agronomicClass_id') ?? $activePrinciple->agronomicClass_id }}" class="form-control form-control-sm" placeholder="Descrição">
                        @if($errors->has('agronomicClass_id'))
                                <h6 class="text-danger" >Digite a Classe Agronônica</h6> 
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Descrição</label>
                        <input type="text" name="description" value="{{old('description') ?? $activePrinciple->description }}" class="form-control form-control-sm" placeholder="Descrição">
                        @if($errors->has('description'))
                                <h6 class="text-danger" >Digite a descrição</h6> 
                        @endif
                    </div>    


                        <label class="form-label" for="email">Selecione as defensivo relacionadas:</label>
                        <div class="row">
                            <?php $index = -1   ?>    
                            @foreach($pesticides as $pesticide)
                                <?php $index++ 
                                 ?>                
                                <div class="col">   
                                    <div class="form-check form-group">
                                        <input type="radio" class="form-check-input" name="pesticide_id[{{$index}}]" id="nome{{$index}}" 
                                        {{((($pesticide->id)) == $activePrinciple_pesticides[$index]) ? 'checked' : ""}} onclick=setRadioBtn() >
                            
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

