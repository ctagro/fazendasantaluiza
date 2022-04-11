<?php

namespace App\Http\Controllers\Join;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Crop_disease;


class JoinController extends Controller
{
    public function join_crop_disease($crop_id,$disease_id)
{

//dd($crop_id,$disease_id);

 $crop = Crop::find($crop_id);

//dd($crop,$disease_id,$join);

$crop->diseases()->attach($disease_id);

$disease = Disease::findOrFail($disease_id);

dd($crop->name,$disease->name,$disease);

return redirect ('plantetc.dashboards.dashboard', compact('crop','disease'));

}

public function locate_diseasesAScrop($crop_id)
{

//dd($crop_id); 



$crop = Crop::find($crop_id);

$crop_name = $crop->name;

$count = count($crop->diseases);

//dd($crop_name);

$diseasesAScrop = $crop->diseases;

//dd($diseases);

//dd($crop->name,$diseasesAScrop);



//dd('0k');

return view('plantetc.join', compact('diseasesAScrop','crop','count'));

}

public function locate_cropsASdisease($disease_id)
{

//dd($disease_id);



$disease = Disease::find($disease_id);

$count = count($disease->crops);

if($count > 0){


}

$cropsASdisease = $disease->crops;


//dd($count,$disease,$cropsASdisease);


return view('plantetc.join', compact('cropsASdisease','disease','count'));

}





}
