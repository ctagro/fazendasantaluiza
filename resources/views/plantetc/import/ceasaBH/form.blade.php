<x-app-layout>
    <div class="row  row-cols-1 row-cols-md-2 g-4">
             <div class="card">
                <div class="card-header d-flex justify-content-between">
                   <div class="header-title">
                      <h4 class="card-title">Importar cotações - CeasaBH</h4>
                   </div>
                </div>
                <div class="card-body">
                   <p>Upload de arquivo CSV com cotações do dia</p>
                   <form  action="{{ route('ceasa.storeImport') }}" method="POST" enctype="multipart/form-data" class="col-12">
                    @method('POST')
                    @csrf
                        <div class="row">
                            <div class="">
                                <label class="form-label" for="validationDefault01"><strong>Data</strong></label>
                                <input type="date" name="date"  value=""  class="form-control" placeholder="$data">     
                            </div>
                            <p></p>
                            <div class="">
                                <label class="form-label" for="validationDefault02"><strong>Selecionar arquivo</strong></label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{old('file')}}">
                            </div>
                            
                        </div>
                        <div class="form-group">
                        <div class="form-check">
                           
                        </div>
                      </div>
                      <div class="form-group">
                         <button class="btn btn-primary" type="submit">Baixar arquivo</button>
                      </div>
                   </form>
                </div>
             </div>
        </div>


 </x-app-layout>