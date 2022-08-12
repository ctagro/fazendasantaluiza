
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                            <div class="bolder">Doença</div>
                          </div>    
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->name}}</div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="bolder">Nome científico</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->scientific_name}}</div>
                          </div>
                          <br>                     
                          <div class="row">
                            <div class="bolder">Descrição:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->description}}</div>
                          </div>
                          <br> 
                          <div class="row">
                            <div class="bolder">Sintomas e danos:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->symptoms}}</div>
                          </div>
                          <br> 
                          <div class="row">
                            <div class="bolder">Tipo de controle:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->controlType->name}}</div>
                          </div>
                          <br>   
                          <div class="row">
                            <div class="bolder">Informações sobre controle</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->name}}</div>
                          </div>
                          <br>
                          <label class="form-label" for="">Principios ativos que combatem a doença/praga:</label>
                          <div class="row">
                              <?php $index = 0   ?>    
                              @foreach($active_principles as $active_principle)
                                  <?php $index++   ?> 
                                  <div class="col-6">   
                                      <div class="form-check form-group">
                                          <a href= "{{ route('activePrinciple.show' ,[ 'activePrinciple' => $active_principle->id  ])}}" class="form-check-label" for="validationFormCheck1">{{$active_principle->name}}</a>
                                      </div>
                                  </div>               
                               @endforeach
                          </div>
                          <br> 
                          <div class="row">
                            <div class="bolder">Nota:</div>
                          </div>
                        
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $disease->note}}</div>                        
                            <br> 
                    </div>
                </div>        
            </div>
        </div>
    </div>        