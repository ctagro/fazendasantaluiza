<div>
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                
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
                           <option value="{{$manufacturer->id}}" {{ $manufacturer->id == $pesticide->manufacturer_id ? 'selected' : ''}}>{{$manufacturer->name}} </option> 
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

<!--================Principio Ativo -->
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
                            <select name="agronomicClass_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                               <option selected disabled value="">Selecione</option>
                               @foreach($agronomicClasses as $agronomicClass)    
                                        <option value="{{$agronomicClass->id}}" {{ $agronomicClass->id == $pesticide->agronomicClass_id ? 'selected' : ''}}>{{$agronomicClass->name}} </option>                 
                                    @endforeach
                            </select> 
                            @if($errors->has('agronomicClass_id'))    
                                <h6 class="text-danger" >Selecione</h6> 
                            @endif 
                         </div>

                        <div class="form-group col-sm-4 ">
                   
                        <label for="colFormLabelSm" class="form-label">Tipo de Formulação</label>
                        <select name="formulationType_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                           <option selected disabled value="">Selecione</option>
                           @foreach($formulationTypes as $formulationType)    
                           <option value="{{$formulationType->id}}" {{ $formulationType->id == $pesticide->formulationType_id ? 'selected' : ''}}>{{$formulationType->name}} </option> 
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
                               <option value="{{$applicationMode->id}}" {{ $applicationMode->id == $pesticide->applicationMode_id ? 'selected' : ''}}>{{$applicationMode->name}} </option> 
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
                            <input type="number" name="dosage" value="{{old('dosage') ?? $pesticide->dosage }}" class="form-control form-control-sm" placeholder="Dosagem">
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

                            <div class="form-group col-sm-4 ">
                                <label for="colFormLabelSm" class="form-label">Classe Toxicológica</label>
                                <select name="toxicologicalClass_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                                   <option selected disabled value="">Selecione </option>
                                   @foreach($toxicologicalClasses as $toxicologicalClass)    
                                   <option value="{{$toxicologicalClass->id}}" {{ $toxicologicalClass->id == $pesticide->toxicologicalClass_id ? 'selected' : ''}}>{{$toxicologicalClass->name}} </option> 
                                        @endforeach
                                </select> 
                                @if($errors->has('toxicologicalClass_id'))    
                                    <h6 class="text-danger" >Selecione</h6> 
                                @endif 
                            </div>
                    </div>

              
                    <div class="row">
                    <div class="form-group col-sm-4 ">
                        <label for="colFormLabelSm" class="form-label">Grupo Químico </label>
                        <select name="chemicalGroup_id" class="form-select form-select-sm mb-3" id="chemicalGroup_id" aria-label=".form-select-lg example" required>
                           <option selected disabled value="">Selecione </option>
                           @foreach($chemicalGroups as $chemicalGroup)    
                           <option value="{{$chemicalGroup->id}}" {{ $chemicalGroup->id == $pesticide->chemicalGroup_id ? 'selected' : ''}}>{{$chemicalGroup->name}} </option> 
                                @endforeach
                        </select> 
                        @if($errors->has('chemicalGroup_id'))    
                            <h6 class="text-danger" >Selecione</h6> 
                        @endif 
                    </div>

                    <div class="form-group col-sm-4 ">
                        <label for="colFormLabelSm" class="form-label">Sitio de Atuação</label>
                        <select name="actionSite_id" class="form-select form-select-sm mb-3" id="agronomicClass_id" aria-label=".form-select-lg example" required>
                           <option selected disabled value="">Selecione </option>
                           @foreach($actionSites as $actionSite)    
                           <option value="{{$actionSite->id}}" {{ $actionSite->id == $pesticide->actionSite_id ? 'selected' : ''}}>{{$actionSite->name}} </option> 
                                @endforeach
                        </select> 
                        @if($errors->has('actionSite_id'))    
                            <h6 class="text-danger" >Selecione</h6> 
                        @endif 
                    </div>

                    <div class="form-group col-sm-4 ">
                        <label for="colFormLabelSm" class="form-label">Modo de Atuação</label>
                        <select name="modeOperation_id" class="form-select form-select-sm mb-3" id="modeOperation_id" aria-label=".form-select-lg example" required>
                           <option selected disabled value="">Selecione </option>
                           @foreach($modeOperations as $modeOperation)    
                           <option value="{{$modeOperation->id}}" {{ $modeOperation->id == $pesticide->modeOperation_id ? 'selected' : ''}}>{{$modeOperation->name}} </option> 
                                @endforeach
                        </select> 
                        @if($errors->has('modeOperation_id'))    
                            <h6 class="text-danger" >Selecione</h6> 
                        @endif 
                    </div>

                </div>

                <div class="form-group">
                    <label for="colFormLabelSm" class="form-label">Mecanismo de Atuação</label>
                    <select name="actuationMechanism_id" class="form-select form-select-sm mb-3" id="actuationMechanism_id" aria-label=".form-select-lg example" required>
                       <option selected disabled value="">Selecione </option>
                       @foreach($actuationMechanisms as $actuationMechanism)    
                       <option value="{{$actuationMechanism->id}}" {{ $actuationMechanism->id == $pesticide->actuationMechanism_id ? 'selected' : ''}}>{{$actuationMechanism->name}} </option> 
                            @endforeach
                    </select> 
                    @if($errors->has('actuationMechanism_id'))    
                        <h6 class="text-danger" >Selecione</h6> 
                    @endif 
                </div>
                
                    <div class="row">
                        <div class="form-group col-sm-4"> 
                            <label class="form-label" for="colFormLabelSm">Intervalo de Aplicações (dias)</label>
                            <input type="number" name="applicationRange" value="{{old('applicationRange') ?? $pesticide->applicationRange }}" class="form-control form-control-sm" >
                            @if($errors->has('applicationRange'))
                                    <h6 class="text-danger" >Digite o Intervalo</h6> 
                            @endif
                        </div>

                            <div class="form-group col-sm-4"> 
                                <label class="form-label" for="colFormLabelSm">Número de Aplicações</label>
                                <input type="number" name="numberApplications" value="{{old('numberApplications') ?? $pesticide->numberApplications }}" class="form-control form-control-sm" >
                                @if($errors->has('numberApplications'))
                                        <h6 class="text-danger" >Digite o Número</h6> 
                                @endif
                        </div>
                    </div> 

                
                    <div class="row">
                        <div class="form-group col-sm-6
                        "> 
                    <div class="form-group">
                        <label for="customFile1" class="form-label custom-file-input">Escolha a foto</label>
                        @if ($pesticide->image != null)
                        <img src="{{ asset('storage/pesticide/'.$pesticide->image)}}" 
                         class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                    @endif
                        <label for="image">Imagem</label>
                        <input type="file" class="form-control form-control-sm"  name='image' value=''>
                    </div>
                </div>

                    <div class="form-group col-sm-6"> 
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
                </div>
            </div>

                   
                    <div class="form-group">
                        <label class="form-label" for="colFormLabelSm">Nota</label>
                        <input type="text" name="note" value="{{old('note') ?? $pesticide->note }}" class="form-control form-control-sm" >
                    </div>


                </div>
            </div>        
        </div>
    </div>
</div> 

