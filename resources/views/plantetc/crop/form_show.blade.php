
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
  
                        <div class="row">
                            <div class="bolder">Cultura</div>
                          </div>    
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $crop->name}}</div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="bolder">Nome científico</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $crop->scientific_name}}</div>
                          </div>
                          <br>                     
                          <div class="row">
                            <div class="bolder">Descrição:</div>
                          </div>
                          <div class="row">
                            <div class="form-control form-control-sm">{{ $crop->description}}</div>
                          </div>
                          <br>                     
  
                            <label class="form-label" for="email">Doenças que atingem a cultura:</label>
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
                            <div class="row">
                                <div class="bolder">Nota:</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $crop->note}}</div>    
                    </div>
                </div>        
            </div>
        </div>
    </div>        