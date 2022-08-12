
    <div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
              <div class="card-body">
           
                            <input type="hidden" name="in_use" value={{"S"}} class="form-control form-control-sm py-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control form-control-sm py-3">


                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Tipo de controle</label>
                                <input type="text" name="name" value="{{old('name') ?? $controlType->name }}" class="form-control form-control-sm" placeholder="Nome">
                                @if($errors->has('name'))
                                        <h6 class="text-danger" >Digite o nome</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Descrição</label>
                                <input type="text" name="description" value="{{old('name') ?? $controlType->description }}" class="form-control form-control-sm" placeholder="Descrição">
                                @if($errors->has('name'))
                                        <h6 class="text-danger" >Digite a descrição</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nota</label>
                                <input type="text" name="note" value="{{old('note') ?? $controlType->note }}" class="form-control form-control-sm" placeholder="Nota">
                            </div>

                            
                            <div>
                                @if(!Request::is('*/edit'))
                                    <input type="hidden" name="in_use" value="S" class="form-control form-control-sm py-3">
                                @else
                                    <div class="form-group">
                                        <label>Ativo: {{$controlType->in_use}} </label>
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