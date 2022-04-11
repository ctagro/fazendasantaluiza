<div class="row">
    <div class="">
        <label class="form-label" for="date"><strong>Data inicial</strong></label>
        <input type="date" name="date_inicial" id="date_inicial" value=""  class="form-control" placeholder="">     
    </div>
    <p></p>
  
    <div class="">
      <label class="form-label" for="data"><strong>Data final</strong></label>
      <input type="date" name="date_final" id="date_final" value=""  class="form-control" placeholder="">     
  </div>
  <p></p>
 
  <div class=""> 
    <label for="validationTooltip04" class="form-label"><strong>Produto</strong></label>
    <select name="product" class="form-select form-select-lg mb-3" id="validationTooltip04" aria-label=".form-select-lg example" required>
       <option selected disabled value="">Selecione o produto</option>
       @foreach($products as $product)    
                <option value="{{$product->name}}">{{$product->name}} </option>                  
            @endforeach
    </select>  
 </div>