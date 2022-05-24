
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                          <div class="form-group col-sm-2"> 
                            <img src="{{ asset('storage/pesticides/'.$pesticide->image)}}" class="img-thumbnail elevation-2"  style="max-width: 100px;"> 
                          </div>
                            <div class="form-group col-sm-5"> 
                              <div class="bolder">Defensivo</div> 
                              <div class="form-control form-control-sm  bg-light text-primary">{{ $pesticide->name}}</div>
                            </div>
                            <div class="form-group col-sm-5"> 
                              <div class="bolder">Fabricante</div>
                              <div class="form-control form-control-sm">{{ $pesticide->manufacturer->name}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Classe Agronômica</div>
                              <div class="form-control form-control-sm">{{ $pesticide->agronomicClass->name}}</div>
                            </div>                       
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Tipo de Formulação</div>
                              <div class="form-control form-control-sm">{{ $pesticide->formulationType->name}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Modo de Aplicação</div>
                              <div class="form-control form-control-sm">{{ $pesticide->applicationMode->name}}</div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Dose Recomendada</div>
                              <div class="form-control form-control-sm">{{ $pesticide->dosage}}</div>
                            </div>
                            <div class="form-group col-sm-4">
                              <div class="bolder">Unidade de dosagem</div>
                              <div class="form-control form-control-sm">{{ $pesticide->unity}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Classe Toxicológica</div>
                              <div class="form-control form-control-sm">{{ $pesticide->toxicologicalClass->name}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Grupo Químico</div>
                              <div class="form-control form-control-sm">{{ $pesticide->chemicalGroup->name}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Sítio de Ação</div>
                              <div class="form-control form-control-sm">{{ $pesticide->actionSite->name}}</div>
                            </div> 
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Modo de Atuação</div>
                              <div class="form-control form-control-sm">{{ $pesticide->modeOperation->name}}</div>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="bolder">Mecanismo de Atuação</div>
                            <div class="form-control form-control-sm">{{ $pesticide->actuationMechanism->name}}</div>
                        </div>

                        <div class="row">
                          <div class="form-group col-sm-4"> 
                            <div class="bolder">Intervalo de Aplicações (dias)</div>
                            <div class="form-control form-control-sm">{{ $pesticide->applicationRange}}</div>
                          </div>
                          <div class="form-group col-sm-4">
                            <div class="bolder">Número de Aplicações (dias)</div>
                            <div class="form-control form-control-sm">{{ $pesticide->numberApplications}}</div>
                          </div>
                        </div>
                                                   
                        <label class="form-label" for="email">Culturas recomendadas:</label>
                        <div class="row">
                            <?php $index = 0   ?>    
                            @foreach($crops as $crop)
                                <?php $index++   ?> 
                                <div class="col">   
                                    <div class="form-check form-group">
                                        <a href= "{{ route('crop.show' ,[ 'crop' => $crop->id  ])}}" class="form-check-label" for="validationFormCheck1">{{$crop->name}}</a>
                                    </div>
                                </div>               
                             @endforeach
                        </div>

                        <label class="form-label" for="email">Doenças que combate:</label>
                        <div class="row">
                            <?php $index = 0   ?>    
                            @foreach($diseases as $disease)
                                <?php $index++   ?> 
                                <div class="col">   
                                    <div class="form-check form-group">
                                        <a href= "{{ route('disease.show' ,[ 'disease' => $disease->id  ])}}" class="form-check-label" for="validationFormCheck1">{{$disease->name}}</a>
                                    </div>
                                </div>                                         
                             @endforeach
                        </div>

                        <label class="form-label" for="email">Principios ativos usados:</label>
                        <div class="row">
                            <?php $index = 0   ?>    
                            @foreach($active_principles as $active_principle)
                                <?php $index++   ?> 
                                <div class="col">   
                                    <div class="form-check form-group">
                                        <a href= "{{ route('activePrinciple.show' ,[ 'activePrinciple' => $active_principle->id  ])}}" class="form-check-label" for="validationFormCheck1">{{$active_principle->name}}</a>
                                    </div>
                                </div>                                         
                             @endforeach
                        </div>

                            <div class="form-group">
                                <div class="bolder">Nota:</div>
                                <div class="form-control form-control-sm">{{ $pesticide->note}}</div>    
                            </div>
                </div>        
            </div>
        </div>
    </div>        