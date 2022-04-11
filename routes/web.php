<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';


//----------------------- Inicio Plantetc -------------------------

// Rota inicial

Route::get('/', [App\Http\Controllers\Plantetc\HomeController::class, 'index'])->name('plantetc.dashboard')->middleware('auth');

Route::namespace('Plantetc')->group(function () {

//    Route::get('plantetc/dashboard', [App\Http\Controllers\Plantetc\HomeController::class, 'index'])->name('plantetc.dashboard')->middleware('auth');
    Route::post('site/profile/profile', [App\Http\Controllers\UserController::class, 'profileUpdate'])->name('profile.update')-> middleware('auth');

});

// Imporação dos dados de preço do Ceasa_BH

Route::namespace('Import')->group(function () {

  Route::get('import', [App\Http\Controllers\Plantetc\Import\PriceCeasaController::class, 'import'])->name('ceasa.import')->middleware('auth');
  Route::post('store-import',[App\Http\Controllers\Plantetc\Import\PriceCeasaController::class,'storeImport'])->name('ceasa.storeImport');
  Route::post('index',[App\Http\Controllers\Plantetc\Import\PriceCeasaController::class,'index'])->name('ceasa.index');
  Route::get('import/{import}/edit', [App\Http\Controllers\Plantetc\Import\PriceCeasaController::class,'edit'])->name('ceasa.edit');

  Route::post('ceasa_research/research', [App\Http\Controllers\Plantetc\Import\CeasaResearchController::class, 'research'])->name('ceasa_research.research');
  Route::get('ceasa_research', [App\Http\Controllers\Plantetc\Import\CeasaResearchController::class, 'consult'])->name('ceasa_research.consult');
  Route::get('ceasa_research/index', [App\Http\Controllers\Plantetc\Import\CeasaResearchController::class, 'index'])->name('ceasa_research.index');
  Route::post('ceasa_research/file', [App\Http\Controllers\Plantetc\Import\CeasaResearchController::class,'file'])->name('ceasa_research.file');

}); 

Route::namespace('Charts')->group(function () {

  Route::post('ceasa_charts_research/research', [App\Http\Controllers\Plantetc\Charts\CeasaChartController::class, 'research'])->name('ceasa_charts_research.research');
  Route::get('ceasa_charts_research', [App\Http\Controllers\Plantetc\Charts\CeasaChartController::class, 'consult'])->name('ceasa_charts_research.consult');
  Route::get('ceasa_charts_research/index', [App\Http\Controllers\Plantetc\Charts\CeasaChartController::class, 'index'])->name('ceasa_charts_research.index');
  Route::post('ceasa_charts_research/file', [App\Http\Controllers\Plantetc\Charts\CeasaChartController::class,'file'])->name('ceasa_charts_research.file');

});

//-------   namespace('Robocar') ------


  Route::get('panel/index', [App\Http\Controllers\Plantetc\Robocar\PanelController::class, 'index'])->name('panel.index');
  Route::get('panel/consult', [App\Http\Controllers\Plantetc\Robocar\PanelController::class, 'consult'])->name('panel.consult');
  Route::post('panel/chart', [App\Http\Controllers\Plantetc\Robocar\PanelController::class, 'chart'])->name('panel.chart');
  Route::post('panel/chart1', [App\Http\Controllers\Plantetc\Robocar\PanelController::class, 'chart1'])->name('panel.chart1');
  Route::get('panel/file', [App\Http\Controllers\Plantetc\Robocar\PanelController::class, 'file'])->name('panel.file');

  Route::get('umidade/index', [App\Http\Controllers\Plantetc\Robocar\UmidadeController::class, 'index'])->name('umidade.index');
  Route::post('umidade/store', [App\Http\Controllers\Plantetc\Robocar\UmidadeController::class, 'consult'])->name('umidade.store');
  Route::get('umidade/chart', [App\Http\Controllers\Plantetc\Robocar\UmidadeController::class, 'chart'])->name('umidade.chart');
  Route::get('umidade/list', [App\Http\Controllers\Plantetc\Robocar\UmidadeController::class, 'file'])->name('umidade.list');


  Route::get('temperatura/index', [App\Http\Controllers\Plantetc\Robocar\TemperaturaController::class, 'index'])->name('temperatura.index');
  Route::get('temperatura/create', [App\Http\Controllers\Plantetc\Robocar\TemperaturaController::class, 'create'])->name('temperatura.create');
  Route::get('temperatura/chart', [App\Http\Controllers\Plantetc\Robocar\TemperaturaController::class, 'chart'])->name('temperatura.chart');
  Route::post('temperatura/store', [App\Http\Controllers\Plantetc\Robocar\TemperaturaController::class,'store'])->name('temperatura.store');

//---------- 

// Dashboard Routes
  Route::get('/dashboard', [App\Http\Controllers\Plantetc\HomeController::class, 'index'])->name('dashboard');

// ----// Teste relacionamento muito pata muitos ------

// ----// Teste relacionamento muito pata muitos Crop------

Route::get('crop/create', [App\Http\Controllers\CropController::class,'create'])->name('crop.create'); 
Route::post('crop/store', [App\Http\Controllers\CropController::class, 'store'])->name('crop.store');
Route::get('crop/index', [App\Http\Controllers\CropController::class, 'index'])->name('crop.index');
Route::get('crop/{crop}', [App\Http\Controllers\CropController::class,'show'])->name('crop.show');
Route::get('crop/{crop}/edit', [App\Http\Controllers\CropController::class,'edit'])->name('crop.edit');
Route::patch('crop/{crop}', [App\Http\Controllers\CropController::class,'update'])->name('crop.update');
Route::delete('crop/{crop}', [App\Http\Controllers\CropController::class,'destroy'])->name('crop.destroy');
Route::get('variety/{crop}', [App\Http\Controllers\CropController::class,'variety'])->name('crop.variety');

Route::get('disease/create', [App\Http\Controllers\Pesticide\DiseaseController::class,'create'])->name('disease.create'); 
Route::post('disease/store', [App\Http\Controllers\Pesticide\DiseaseController::class, 'store'])->name('disease.store');
Route::get('disease/index', [App\Http\Controllers\Pesticide\DiseaseController::class, 'index'])->name('disease.index');
Route::get('disease/{disease}', [App\Http\Controllers\Pesticide\DiseaseController::class,'show'])->name('disease.show');
Route::get('disease/{disease}/edit', [App\Http\Controllers\Pesticide\DiseaseController::class,'edit'])->name('disease.edit');
Route::patch('disease/{disease}', [App\Http\Controllers\Pesticide\DiseaseController::class,'update'])->name('disease.update');
Route::delete('disease/{disease}', [App\Http\Controllers\Pesticide\DiseaseController::class,'destroy'])->name('disease.destroy');


Route::get('join/{crop_id},{desease_id}', [App\Http\Controllers\Join\JoinController::class, 'join_crop_disease'])->name('join');
Route::get('locate_diseasesAScrop/{crop_id}', [App\Http\Controllers\Join\JoinController::class, 'locate_diseasesAScrop'])->name('locate_diseasesAScrop');


Route::get('crop_variety/create', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'create'])->name('crop_variety.create'); 
Route::post('crop_variety/store', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class, 'store'])->name('crop_variety.store');
Route::get('crop_variety/index', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class, 'index'])->name('crop_variety.index');
Route::get('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'show'])->name('crop_variety.show');
Route::get('crop_variety/{crop_variety}/edit', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'edit'])->name('crop_variety.edit');
Route::patch('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'update'])->name('crop_variety.update');
Route::delete('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'destroy'])->name('crop_variety.destroy');



Route::get('locate_cropsASdisease/{disease_id}', [App\Http\Controllers\Join\JoinController::class, 'locate_cropsASdisease'])->name('locate_cropsASdisease');



  //--------------------  Fim Plantetc ------------------------


/*

 Route::get('/', function () {
    return view('dashboards.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


*/


  //UI Pages Routs
//Route::get('/', [HomeController::class, 'uisheet'])->name('uisheet');
Route::get('uisheet', [HomeController::class, 'uisheet'])->name('uisheet');
 
 
 
  //App Details Page => 'Dashboard'], function() {
    Route::group(['prefix' => 'MenuStyle'], function() {
      //MenuStyle Page Routs
      Route::get('horizontal', [HomeController::class, 'horizontal'])->name('MenuStyle.horizontal');
      Route::get('dualhorizontal', [HomeController::class, 'dualhorizontal'])->name('MenuStyle.dualhorizontal');
      Route::get('dualcompact', [HomeController::class, 'dualcompact'])->name('MenuStyle.dualcompact');
      Route::get('boxed', [HomeController::class, 'boxed'])->name('MenuStyle.boxed');
      Route::get('boxedfancy', [HomeController::class, 'boxedfancy'])->name('MenuStyle.boxedfancy');
    });

  //App Details Page => 'special-pages'], function() {
  Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtlsupport', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
  });

  //Widget Routs
  Route::group(['prefix' => 'Widget'], function() {
    Route::get('widgetbasic', [HomeController::class, 'widgetbasic'])->name('Widget.widgetbasic');
    Route::get('widgetchart', [HomeController::class, 'widgetchart'])->name('Widget.widgetchart');
    Route::get('widgetcard', [HomeController::class, 'widgetcard'])->name('Widget.widgetcard');
  });

  //Maps Routs
  Route::group(['prefix' => 'Maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('Maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('Maps.vector');
  });

  //Auth pages Routs
  Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
  });
  
  //User pages Routs
  Route::group(['prefix' => 'Users'], function() {
    Route::get('userprofile', [HomeController::class, 'userprofile'])->name('Users.userprofile');
    Route::get('useradd', [HomeController::class, 'useradd'])->name('Users.useradd');
    Route::get('userlist', [HomeController::class, 'userlist'])->name('Users.userlist');
  });

  //Error Page Route
  Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
  });



//Forms Pages Routs
  Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
  });


//Table Page Routs
  Route::group(['prefix' => 'table'], function() {
   Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
   Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
  });

  //Icons Page Routs
  Route::group(['prefix' => 'Icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('Icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('Icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('Icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('Icons.colored');
  });
//Extra Page Routs
  Route::get('PrivacyPolicy', [HomeController::class, 'PrivacyPolicy'])->name('PrivacyPolicy');
  Route::get('TermsofUse', [HomeController::class, 'TermsofUse'])->name('TermsofUse');

  

  