
 <p>{{'index: '.  $index}}</p>
 <p>{{'names[$index]: '.$names[$index]}}</p> 
 <p>{{'$crop_diseases[$index]: '.$crop_diseases[$index]}}</p> <!-- quando não existe é null -->
 <p>{{'$disease->name: '.$disease->name}}</p> 
 <p>{{'$disease->id: '.(($disease->id)-1)}}</p> <!-- para ser igual ao index -->
 <p>{{'isset: '.!isset($crop_diseases[$index])}}</p>
 <p>{{(($disease->id) == intval($crop_diseases[$index]))}}</p>

 public function update(Request $request, Crop $crop)
 {

  //  dd($crop); 
   
   $dataRequest = $this->validateRequest();

//  dd($crop->id);

   $data['name'] = $dataRequest['name'];

   $update = $crop->update($data);

//   $disea = $diseases->crop();

 //  dd($disea);
   

//   dd($update);

  $crop_update = Crop::find($crop['id']);

//   dd($crop_update->id,$crop->id);

 //   dd($crop_update);

     $diseases = $request;

     $crop_diseases = $crop->diseases;
     $cc =count($crop_diseases);
   //  dd($cc);
     $disea = $diseases->crop;
     $crop_id = $crop->id;

//      dd($disea, $crop_diseases,$crop_id);

     $crop->diseases;

//dd($diseases);

//     $diseases_id = array_keys($diseases['disease_id']);

 //    $dd = $crop->diseases;

//   dd($crop,$diseases, $dd );

   

 //   $update = $crop_update->diseases()->updateExistingPivot($diseases, $diseases_id);

//    $update = $crop_update->diseases()->toggle($diseases_id);

$cont =0;
//  dd($update);
 if($diseases['disease_id'] != null)
 {
     $diseases_id = array_keys($diseases['disease_id']);
  //   dd($diseases_id);

     foreach($diseases_id as $disease_id)
         {
             $cont++;
             $crop->diseases()->detach($disease_id);
            
             

         }
         
  //     $disease = Disease::findOrFail($diseases_id[0]);

 }

// dd($diseases,$cont);

 if($diseases['disease_id'] != null)
 {
     $diseases_id = array_keys($diseases['disease_id']);

//    dd($diseases_id);
$count =0;
     foreach($diseases_id as $disease_id)
         {
          //  $count++;
           // dd($disease_id);
             $crop_update->diseases()->attach($diseases_id);

         }
         
  //     $disease = Disease::findOrFail($diseases_id[0]);

 }

//  $crop->diseases()->attach($disease_id);



 //  $update =  $data->find(1)->diseases()->updateExistingPivot($data);

//  $update = $crop->diseases()->sync($diseases_id);


//     dd($crop,$diseases,$count);


   //  $update = $crop -> update($diseases);

   //  dd($update);

     if ($update)

     return redirect()
                     ->route('crop.show' ,[ 'crop' => $crop->id ])
                     ->with('sucess', 'Sucesso ao salvar alteração');
                 

     return redirect()
                 ->back()
                 ->with('error',  'Falha ao salvar alteração');     

 }


 /*
function myFunction() {
    
     document.getElementById("myCheck_2").checked = false;
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
    }
    }
    function myFunction_2() {
    document.getElementById("text").value='female'
     document.getElementById("myCheck").checked = false;
      var checkBox = document.getElementById("myCheck_2");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
      }
    }
    Male: <input type="checkbox" id="myCheck"  onclick="myFunction()">
    Female: <input type="checkbox" id="myCheck_2"  onclick="myFunction_2()">
    
    <input type="text" id="text" placeholder="Name">
*/
--


---------



function setRadioBtn(idRadioBtn) {

  if (setradioBtn.checked = true)

  {
      setRadioBtn.onclick = setRadioBtn;
    } else {
      setRadioBtn.onclick =  setRadioBtn;
  };

}


function setRadiolist(idRadioBtn) {

  const listRadioBtn = document.querySelectorAll('.form-check-input');
  let count = 0;

  while (count < (listRadioBtn.lenght)) {
  
  setRadioBooton = document.querySelector(count).checked;

  }

}