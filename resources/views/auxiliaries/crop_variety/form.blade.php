
    <div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
         <!--               <div class="header-title">
                            <h4 class="card-title">Variedade cultura</h4>
                        </div>
                    </div>
    -->             <div class="card-body">
           
                            <input type="hidden" name="in_use" value={{"S"}} class="form-control form-control-sm py-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control form-control-sm py-3">
    
                         
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Cultura</label>
                                <select name="crop_id"  id="crop_id" value="{{old('typeaccount')}}" class="form-select" required aria-label="select example">
                                    <option value="" disabled selected>Selecione a cultura</option> 
                                        @foreach($crops as $crop)
                                            <option value="{{$crop->id}}" {{ $crop->id == $crop_variety->crop_id ? 'selected' : ''}} >{{$crop->name}} </option>       
                                        @endforeach
                                    </select>
                                    @if($errors->has('crop_id'))
                                        <h6 class="text-danger" >Selecione a cultura</h6> 
                                    @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Variedade</label>
                                <input type="text" name="name" value="{{old('name') ?? $crop_variety->name }}" class="form-control form-control-sm" placeholder="Variedade">
                                @if($errors->has('name'))
                                        <h6 class="text-danger" >Digite o Variedade</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Descrição</label>
                                <input type="text" name="description" value="{{old('description') ?? $crop_variety->description }}" class="form-control form-control-sm" placeholder="Descrição">
                                @if($errors->has('description'))
                                        <h6 class="text-danger" >Digite a descrição</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nota</label>
                                <input type="text" name="note" value="{{old('note') ?? $crop_variety->note }}" class="form-control form-control-sm" placeholder="Nota">
                            </div>

                            
                            <div>
                                @if(!Request::is('*/edit'))
                                    <input type="hidden" name="in_use" value="S" class="form-control form-control-sm py-3">
                                @else
                                    <div class="form-group">
                                        <label>Ativo: {{$crop->in_use}} </label>
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
      
                            <div class="form-group">
                                <label for="customFile1" class="form-label custom-file-input">Escolha a foto</label>
                                @if ($crop_variety->image != null)
                                <img src="{{ asset('storage/crop_varieties/'.$crop_variety->image)}}" 
                                 class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                            @endif
                                <label for="image">Imagem</label>
                                <input type="file" class="form-control form-control-sm"  name='image' value='crop_avatar.png'>
                            </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>        