<div>
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                
                    <div class="row">
                        <div class="form-group col-sm-6"> 
                            <label class="form-label" for="colFormLabelSm">Nome do defensivo</label>
                            <input type="text" name="name" value="{{old('name') ?? $pesticide->name }}" class="form-control form-control-sm  bg-light text-primary" placeholder="Defensivo">
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
                   
                <div class="form-group">
                    <label class="form-label" for="colFormLabelSm">Nota</label>
                    <input type="text" name="note" value="{{old('note') ?? $pesticide->note }}" class="form-control form-control-sm" >
                </div>

<!--=========== Relacionamento com a Cultura Crop  ================== -->


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
                                    <?php $indexCrop= 0   ?>    
                                    @foreach($relationCrop_ids as $relationCrop_id)
                                        <?php $indexCrop++ ?> 
                                        <div class="col">   
                                            <div class="form-check form-group"> 
                                                    <input type="radio" class="form-check-input" name="beforeCrop_id[{{$indexCrop}}]" id="validationFormCheck1" 
                                                    {{((($relationCrop_id->id)) == $relationCrop_lists[$indexCrop]) ? 'checked': ""}} />
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
                            <h6 class="card-title">Atualizar Culturas - Repita os que permanezem no relacionamento</h6>
                        </div>
                    </div>  
                <div class="card-body">
                    <div class="user-post-data">
                        <div class="d-flex flex-wrap">
                            <div class="media-support-info mt-2">
                                <?php $indexCrop = 0   ?>    
                                @foreach($relationCrop_ids as $relationCrop_id)
                                    <?php $indexCrop++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="afterCrop_id[{{$indexCrop}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="afterCrop_id[{{$indexCrop}}]">{{$relationCrop_id->name}}</label>
                                        </div>
                                    </div>                              
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!----  Excluir os relacionamentos  ------------------>

            <div class="form-check form-group">
                <input type="radio" name="clearCrop_id" class="form-check-input" id="validationFormCheck1" >
                <label class="text-danger" for="clearCrop_id">Excluir todas as Culturas</label>
            </div>

<!--=========== Relacionamento com a Diseases   ================== -->


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
                                        <?php $indexDisease = 0   ?>    
                                        @foreach($relationDisease_ids as $relationDisease_id)
                                            <?php $indexDisease++ ?>                
                                            <div class="col">   
                                                <div class="form-check form-group"> 
                                                        <input type="radio" class="form-check-input" name="beforeDisease_id[{{$indexDisease}}]" id="validationFormCheck1" 
                                                        {{((($relationDisease_id->id)) == $relationDisease_lists[$indexDisease]) ? 'checked': ""}} />
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
                                <h6 class="card-title">Atualizar Doenças/Pragas - Repita os que permanezem no relacionamento</h6>
                            </div>
                        </div>  
                    <div class="card-body">
                        <div class="user-post-data">
                            <div class="d-flex flex-wrap">
                                <div class="media-support-info mt-2">
                                    <?php $indexDisease = 0   ?>    
                                    @foreach($relationDisease_ids as $relationDisease_id)
                                        <?php $indexDisease++   ?> 
                                        <div class="col">   
                                            <div class="form-check form-group">
                                                <input type="radio" name="afterDisease_id[{{$indexDisease}}]" class="form-check-input" id="validationFormCheck1" >
                                                <label class="form-check-label" for="afterDisease_id[{{$indexDisease}}]">{{$relationDisease_id->name}}</label>
                                            </div>
                                        </div>                              
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!----  Excluir os relacionamentos  ------------------>

            <div class="form-check form-group">
                <input type="radio" name="clearDisease_id" class="form-check-input" id="validationFormCheck1" >
                <label class="text-danger" for="clearDisease_id">Excluir todas as Doenças/Pragas</label>
            </div>

                <!--=========== Relacionamento com a Principio Ativo Crop  ================== -->


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
                                    <?php $indexActive_principle = 0   ?>    
                                    @foreach($relationActive_principle_ids as $relationActive_principle_id)
                                        <?php $indexActive_principle++ ?>                
                                        <div class="col">   
                                            <div class="form-check form-group"> 
                                                    <input type="radio" class="form-check-input" name="beforeActive_principle_id[{{$indexActive_principle}}]" id="validationFormCheck1" 
                                                    {{((($relationActive_principle_id->id)) == $relationActive_principle_lists[$indexActive_principle]) ? 'checked': ""}} />
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
                            <h6 class="card-title">Atualizar Princípios Ativos- Repita os que permanezem no relacionamento</h6>
                        </div>
                    </div>  
                <div class="card-body">
                    <div class="user-post-data">
                        <div class="d-flex flex-wrap">
                            <div class="media-support-info mt-2">
                                <?php $indexActive_principle = 0   ?>    
                                @foreach($relationActive_principle_ids as $relationActive_principle_id)
                                    <?php $indexActive_principle++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="afterActive_principle_id[{{$indexActive_principle}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="afterActive_principle_id[{{$indexActive_principle}}]">{{$relationActive_principle_id->name}}</label>
                                        </div>
                                    </div>                              
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>


<!----  Excluir os relacionamentos  ------------------>

            <div class="form-check form-group">
                <input type="radio" name="clearActive_principle_id" class="form-check-input" id="validationFormCheck1" >
                <label class="text-danger" for="clearActive_principle_id">Excluir todos os Princípios Ativos</label>
            </div>
<!-- ---------------------------------->

                    <div class="form-group col-sm-6"> 
                    <div>
                        @if(!Request::is('*/edit'))
                            <input type="hidden" name="in_use" value="S" class="form-control form-control-sm py-3">
                        @else
                            <div class="form-group">
                                <label>Ativo: {{$pesticide->in_use}} </label>
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
    </div>
</div>