
    <div>
        <div class="row">
            <div class="col">
                <div class="card">
    
                    <div class="card-body text-sm-left">
                    
                           
                            <div class="row">
                                <div class="bolder">Cultura</div>
                              </div>    
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $crop_variety->crop->name}}</div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="bolder">Variedade</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $crop_variety->name}}</div>
                              </div>
                              <br>                     
                              <div class="row">
                                <div class="bolder">Descrição:</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $crop_variety->description}}</div>
                              </div>
                              <br>                     
                              <div class="row">
                                <div class="bolder">Nota:</div>
                              </div>
                              <div class="row">
                                <div class="form-control form-control-sm">{{ $crop_variety->note}}</div>

                                <div class="row">
                                  Imagem :
                                  <img src="{{ asset('storage/crop_varieties/'.$crop_variety->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                                </div>

                              </div>
            

                    </div>
                </div>        
            </div>
        </div>
    </div>        