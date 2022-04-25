
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                            <div class="bolder">Doença</div>
                          </div>    
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $pesticide->name}}</div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="bolder">Nome científico</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $pesticide->scientific_name}}</div>
                          </div>
                          <br>                     
                          <div class="row">
                            <div class="bolder">Descrição:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $pesticide->description}}</div>
                          </div>
                          <br> 
                          <div class="row">
                            <div class="bolder">Sintomas:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $pesticide->symptoms}}</div>
                          </div>
                          <br> 
                          <div class="row">
                            <div class="bolder">Controles:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $pesticide->control}}</div>
                          </div>
                          <br>                     
    
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
                                <div class="form-control form-control-sm">{{ $pesticide->note}}</div>    
                    </div>
                </div>        
            </div>
        </div>
    </div>        