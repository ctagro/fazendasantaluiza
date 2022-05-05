
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Defensivo</div> 
                              <div class="form-control form-control-sm">{{ $defensivo->name}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Fabricante</div>
                              <div class="form-control form-control-sm">{{ $defensivo->manufacturer->name}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Classe Agronômica</div>
                              <div class="form-control form-control-sm">{{ $defensivo->agronomicClass->name}}</div>
                            </div>
                        </div>
                          
                        <div class="row"> 
                              <div class="form-group col-sm-4"> 
                              <div class="bolder">Tipo de Formulação</div>
                              <div class="form-control form-control-sm">{{ $defensivo->formulationType->name}}</div>
                            </div>
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Dose Recomendada</div>
                              <div class="form-control form-control-sm">{{ $defensivo->dosage}}</div>
                            </div>
                            <div class="form-group col-sm-4">
                              <div class="bolder">Unidade de dosagem</div>
                              <div class="form-control form-control-sm">{{ $defensivo->unity}}</div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Modo de Aplicação</div>
                              <div class="form-control form-control-sm">{{ $defensivo->applicationMode->name}}</div>
                            </div> 
                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Classe Toxicológica</div>
                              <div class="form-control form-control-sm">{{ $defensivo->toxicologicalClass->name}}</div>
                            </div>

                            <div class="form-group col-sm-4"> 
                              <div class="bolder">Grupo Químico</div>
                              <div class="form-control form-control-sm">{{ $defensivo->grupo_quimico->name}}</div>
                            </div>                
                        </div>
                                         
                       
                        <div class="row">
                          <div class="form-group col-sm-4"> 
                            <div class="bolder">Sítio de Ação</div>
                            <div class="form-control form-control-sm">{{ $defensivo->actionSite->name}}</div>
                          </div> 

                          <div class="form-group col-sm-4"> 
                            <div class="bolder">Modo de Atuação</div>
                            <div class="form-control form-control-sm">{{$defensivo->modo_atuacao->name}}</div>
                          </div>

                          <div class="form-group col-sm-4"> 
                            <div class="bolder">Mecanismo de Atuação</div>
                            <div class="form-control form-control-sm">{{ $defensivo->actuationMechanism->name}}</div>
                          </div>
                        </div> 
                      <div class="row">
                        <div class="form-group col-sm-4"> 
                          <div class="bolder">Intervalo de Aplicações (dias)</div>
                          <div class="form-control form-control-sm">{{ $defensivo->applicationRange}}</div>
                        </div>
                        <div class="form-group col-sm-4">
                          <div class="bolder">Número de Aplicações (dias)</div>
                          <div class="form-control form-control-sm">{{ $defensivo->numberApplications}}</div>
                        </div>
                      </div>
                                                   
                            <label class="form-label" for="email">Doenças que atingem a cultura:</label>
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
                            <div class="row">
                                <div class="bolder">Nota:</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $defensivo->note}}</div>    
                    </div>
                </div>        
            </div>
        </div>
    </div>        