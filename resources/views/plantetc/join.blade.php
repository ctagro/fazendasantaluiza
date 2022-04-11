<x-app-layout>



    <p>
    @foreach($diseasesAScrop as $disease)
       <p> {{$disease->name}} </P>
    @endforeach
    </p>

             <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"> Cultura</h4>
               </div>
            </div>
            <div class="card-body">
               <p>Doença:  {{$crop->name}} tem relacionadas {{$count}} doenças</P>
            
            <form  action="" method="POST" enctype="multipart/form-data" class="col-12">
                  @method('POST')
                  @csrf
                  
            @foreach($diseasesAScrop as $disease)
                  <div class="form-check form-group">
                     <input type="checkbox" class="form-check-input" id="validationFormCheck1" required>
                     <label class="form-check-label" for="validationFormCheck1">{{$disease->id}}    {{$disease->name}}</label>
                     <div class="invalid-feedback">Example invalid feedback text</div>
                  </div>
            @endforeach

                  <div class="form-check">
                     <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio-stacked" required>
                     <label class="form-check-label" for="validationFormCheck2">Toggle this radio</label>
                  </div>



                  <div class="form-check form-group">
                     <input type="radio" class="form-check-input" id="validationFormCheck3" name="radio-stacked" required>
                     <label class="form-check-label" for="validationFormCheck3">Or toggle this other radio</label>
                     <div class="invalid-feedback">More example invalid feedback text</div>
                  </div>
            

               <form class="was-validated">
                  <div class="form-group">
                     <label for="validationTextarea" class="form-label">Textarea</label>
                     <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                     <div class="invalid-feedback">
                        Please enter a message in the textarea.
                     </div>
                  </div>

                  <div class="form-group">
                     <select class="form-select" required aria-label="select example">
                        <option value="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                     <div class="invalid-feedback">Example invalid select feedback</div>
                  </div>
                  <div class="form-group mb-0">
                     <input type="file" class="form-control" aria-label="file example" required>
                     <div class="invalid-feedback">Example invalid form file feedback</div>
                  </div>
                  <br>
                  <div class="form-group">
                     <button class="btn btn-primary" type="submit">Cadastrar </button>
                  </div>
               
               </form>
            </div>
         </div>
      </div>
   </x-app-layout>