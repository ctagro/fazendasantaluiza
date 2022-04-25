
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body">

                            <input type="hidden" name="in_use" value={{"S"}} class="form-control form-control-sm py-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control form-control-sm py-3">
                   
                            <div class="row">
                                <div class="form-group col-sm-6"> 
                                    <label class="form-label" for="colFormLabelSm">Nome do defensivo</label>
                                    <input type="text" name="name" value="{{old('name') ?? $pesticide->name }}" class="form-control form-control-sm" placeholder="Defensivo">
                                    @if($errors->has('name'))
                                            <h6 class="text-danger" >Digite a Nome</h6> 
                                    @endif
                                </div>
                        
                            <div class="form-group col-sm-6"> 
                                <label for="colFormLabelSm" class="form-label">Fabricante</label>
                                <select name="manufacturer_id" class="form-select form-select-sm mb-3" id="manufacturer_id" aria-label=".form-select-lg example" required>
                                   <option selected disabled value="">Selecione a Fabricante</option>
                                   @foreach($manufacturers as $manufacturer)    
                                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}} </option>                  
                                        @endforeach
                                </select> 
                                @if($errors->has('manufacturer_id'))    
                                    <h6 class="text-danger" >Selecione</h6> 
                                @endif 
                             </div>
                        </div>


 <!--===================Indicações-->                           
                            <label class="form-label" for="name">Selecione as indicações:</label>
                            <div class="row">
                                <?php $index = 0   ?> 
                                @foreach($diseases as $disease)
                                    <?php $index++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="disease_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="disease_id[{{$index}}]">{{$disease->name}}</label>
                                            <div class="invalid-feedback">Indicações</div>  
                                        </div>
                                    </div>
                                             
                                 @endforeach
                            </div>

<!--============Culturas  -->
                            <label class="form-label" for="name">Selecione culturas indicadas:</label>
                            <div class="row">
                                <?php $index = 0   ?> 
                                @foreach($crops as $crop)
                                    <?php $index++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="crop_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="crop_id[{{$index}}]">{{$crop->name}}</label>
                                            <div class="invalid-feedback">Culturas indicadas</div>  
                                        </div>
                                    </div>                    
                                 @endforeach
                            </div>

<!--================Primcipio Ativo -->
                            <label class="form-label" for="name">Selecione os principios ativos:</label>
                            <div class="row">
                                <?php $index = 0   ?> 
                                @foreach($active_principles as $active_principle)
                                    <?php $index++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="active_principle_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="active_principle_id[{{$index}}]">{{$active_principle->name}}</label>
                                            <div class="invalid-feedback">Principio ativos</div>  
                                        </div>
                                    </div>                      
                                 @endforeach
                            </div>
                   
                            <div class="row">

                                <div class="form-group col-sm-4"> 
                                    <label for="colFormLabelSm" class="form-label">Classe Agronômica</label>
                                    <select name="formulationType_id" class="form-select form-select-sm mb-3" id="formulationType_id" aria-label=".form-select-lg example" required>
                                       <option selected disabled value="">Selecione</option>
                                       @foreach($agronomicClasses as $agronomicClass)    
                                                <option value="{{$agronomicClass->id}}">{{$agronomicClass->name}} </option>                  
                                            @endforeach
                                    </select> 
                                    @if($errors->has('formulationType_id'))    
                                        <h6 class="text-danger" >Selecione</h6> 
                                    @endif 
                                 </div>

                                <div class="form-group col-sm-4 ">
                           
                                <label for="colFormLabelSm" class="form-label">Tipo de Formulação</label>
                                <select name="formulationType_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                                   <option selected disabled value="">Selecione</option>
                                   @foreach($formulationTypes as $formulationType)    
                                            <option value="{{$formulationType->id}}">{{$formulationType->name}} </option>                  
                                        @endforeach
                                </select> 
                                @if($errors->has('formulationType_id'))    
                                    <h6 class="text-danger" >Selecione</h6> 
                                @endif 
                            </div>

                         
                            <div class="form-group col-sm-4 ">
                                    <label for="colFormLabelSm" class="form-label">Modo de Aplicação</label>
                                    <select name="applicationMode_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                                       <option selected disabled value="">Selecione </option>
                                       @foreach($applicationModes as $applicationMode)    
                                                <option value="{{$applicationMode->id}}">{{$applicationMode->name}} </option>                  
                                            @endforeach
                                    </select> 
                                    @if($errors->has('applicationMode_id'))    
                                        <h6 class="text-danger" >Selecione</h6> 
                                    @endif 
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-4"> 
                                    <label class="form-label" for="colFormLabelSm">Dose recomendada</label>
                                    <input type="number" name="dosage" value="{{old('dosage') ?? $pesticide->dosege }}" class="form-control form-control-sm" placeholder="Dosagem">
                                    @if($errors->has('dosage'))
                                            <h6 class="text-danger" >Digite a dose</h6> 
                                    @endif
                                </div>

                                <div class="form-group col-sm-4"> 
                                        <label class="form-label" for="colFormLabelSm">Unidade</label>
                                        <input type="text" name="unity" value="{{old('unity') ?? $pesticide->unity }}" class="form-control form-control-sm" placeholder="Unidade">
                                        @if($errors->has('unity'))
                                                <h6 class="text-danger" >Digite a Unidade</h6> 
                                        @endif
                                    </div>

                                <div class="form-group col-sm-4"> 
                                    <label class="form-label" for="colFormLabelSm">Modo de Aplicação</label>
                                    <input type="text" name="applicationMode_id" value="{{old('applicationMode_id') ?? $pesticide->applicationMode_id }}" class="form-applicationMode_id form-control-sm" placeholder="Modo de Aplicação">
                                    @if($errors->has('applicationMode_id'))
                                            <h6 class="text-danger">Modo de Aplicação</h6> 
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Classe Toxicológica </label>
                                <input type="text" name="toxicologicalClass_id" value="{{old('toxicologicalClass_id') ?? $pesticide->toxicologicalClass_id }}" class="form-toxicologicalClass_id form-control-sm" placeholder="Classe Toxicológica ">
                                @if($errors->has('toxicologicalClass_id'))
                                        <h6 class="text-danger" >Classe Toxicológica </h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Grupo Químico</label>
                                <input type="text" name="chemicalGroup_id" value="{{old('chemicalGroup_id') ?? $pesticide->chemicalGroup_id }}" class="form-chemicalGroup_id form-control-sm" placeholder="Grupo Químico">
                                @if($errors->has('dosage'))
                                        <h6 class="text-danger" >Grupo Químico</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Dose Recomendada</label>
                                <input type="text" name="dosage" value="{{old('dosage') ?? $pesticide->dosage }}" class="form-dosage form-control-sm" placeholder="Dose Recomendada">
                                @if($errors->has('dosage'))
                                        <h6 class="text-danger" >Dose Recomendada</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Sítio de Ação</label>
                                <input type="text" name="actionSite_id" value="{{old('actionSite_id') ?? $pesticide->actionSite_id }}" class="form-actionSite_id form-control-sm" placeholder="Sítio de Ação">
                                @if($errors->has('actionSite_id'))
                                        <h6 class="text-danger" >Sítio de Ação</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Modo de Atuação</label>
                                <input type="text" name="modeOperation_id" value="{{old('modeOperation_id') ?? $pesticide->modeOperation_id }}" class="form-modeOperation_id form-control-sm" placeholder="Modo de Atuação">
                                @if($errors->has('modeOperation_id'))
                                        <h6 class="text-danger" >Modo de Atuação</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Mecanismo de Atuação</label>
                                <input type="text" name="actuationMechanism" value="{{old('actuationMechanism') ?? $pesticide->actuationMechanism }}" class="form-actuationMechanism form-control-sm" placeholder="Mecanismo de Atuação">
                                @if($errors->has('actuationMechanism'))
                                        <h6 class="text-danger" >Mecanismo de Atuação</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Intervalo de Aplicações</label>
                                <input type="number" name="applicationRange" value="{{old('applicationRange') ?? $pesticide->applicationRange }}" class="form-applicationRange form-control-sm" placeholder="Intervalo de Aplicações">
                                @if($errors->has('applicationRange'))
                                        <h6 class="text-danger" >Intervalo de Aplicações</h6> 
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Número de Aplicações</label>
                                <input type="number" name="numberApplications" value="{{old('numberApplications') ?? $pesticide->numberApplications }}" class="form-numberApplications form-control-sm" placeholder="Número de Aplicações">
                                @if($errors->has('numberApplications'))
                                        <h6 class="text-danger" >Número de Aplicações</h6> 
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="customFile1" class="form-label custom-file-input">Escolha a foto</label>
                                @if ($pesticide->image != null)
                                <img src="{{ asset('storage/pesticide/'.$pesticide->image)}}" 
                                 class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                            @endif
                                <label for="image">Imagem</label>
                                <input type="file" class="form-control form-control-sm"  name='image' value=''>
                            </div>
                           
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Nota</label>
                                <input type="text" name="note" value="{{old('note') ?? $pesticide->note }}" class="form-control form-control-sm" placeholder="Nota">
                            </div>

                    </div>
                </div>        
            </div>
        </div>
    </div>        