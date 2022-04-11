<div class="row">
    <input type="hidden" name="medidor" value="Estufa 1" >
    <input type="hidden" name="location" value="Lera 10" >

    <div class="form-group row">
        <input type="number"  name="valor"  min="0" max="60" >
          @if($errors->has('valor'))
              <h6 class="text-danger" >Digite o valor</h6> 
          @endif
      </div> 
  </div>


