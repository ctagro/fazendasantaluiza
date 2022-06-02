
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                            <div class="bolder">Cultura</div>
                          </div>    
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $activePrinciple->name}}</div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="bolder">Classe Agronômica</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $activePrinciple->agronomicClass->name}}</div>
                          </div>
                          <br>                     
                          <div class="row">
                            <div class="bolder">Descrição:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $activePrinciple->description}}</div>
                          </div>
                          <br>                       
   
                            <label class="form-label" for="email">Defensivos relacionados:</label>
                            <div class="row">
                                <?php $index = 0   ?>    
                                @foreach($pesticides as $pesticide)
                                    <?php $index++   ?> 
                                    <div class="col-6">   
                                        <div class="form-check form-group">                               
                                            <a href= "{{ route('pesticide.show' ,[ 'pesticide' => $pesticide->id  ])}}" class="form-check-label" for="validationFormCheck1">{{$pesticide->name}}</a>
                                        </div>
                                    </div>
                                             
                                 @endforeach
                            </div>
                            <div class="row">
                                <div class="bolder">Nota:</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $activePrinciple->note}}</div>    
                    </div>
                </div>        
            </div>
        </div>
    </div>        