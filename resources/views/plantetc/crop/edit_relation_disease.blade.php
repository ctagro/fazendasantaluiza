               
                        <form >
                            
                            <label class="form-label" for="name">Selecione as doenças relacionadas:</label>
                            <div class="row">
                                <?php $index = 0   ?>    
                                @foreach($diseases as $disease)
                                    <?php $index++   ?> 
                                    <div class="col">   
                                        <div class="form-check form-group">
                                            <input type="radio" name="disease_id[{{$index}}]" class="form-check-input" id="validationFormCheck1" >
                                            <label class="form-check-label" for="disease_id[{{$index}}]">{{$disease->name}}</label>
                                        </div>
                                    </div>                              
                                 @endforeach
                             </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </form>

