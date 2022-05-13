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

Route::get('activePrinciple/create', [App\Http\Controllers\Pesticide\ActivePrincipleController::class,'create'])->name('activePrinciple.create'); 
Route::post('activePrinciple/store', [App\Http\Controllers\Pesticide\ActivePrincipleController::class, 'store'])->name('activePrinciple.store');
Route::get('activePrinciple/index', [App\Http\Controllers\Pesticide\ActivePrincipleController::class, 'index'])->name('activePrinciple.index');
Route::get('activePrinciple/{activePrinciple}', [App\Http\Controllers\Pesticide\ActivePrincipleController::class,'show'])->name('activePrinciple.show');
Route::get('activePrinciple/{activePrinciple}/edit', [App\Http\Controllers\Pesticide\ActivePrincipleController::class,'edit'])->name('activePrinciple.edit');
Route::patch('activePrinciple/{activePrinciple}', [App\Http\Controllers\Pesticide\ActivePrincipleController::class,'update'])->name('activePrinciple.update');
Route::delete('activePrinciple/{activePrinciple}', [App\Http\Controllers\Pesticide\ActivePrincipleController::class,'destroy'])->name('activePrinciple.destroy');

Route::get('pesticide/create', [App\Http\Controllers\Pesticide\PesticideController::class,'create'])->name('pesticide.create'); 
Route::post('pesticide/store', [App\Http\Controllers\Pesticide\PesticideController::class, 'store'])->name('pesticide.store');
Route::get('pesticide/index', [App\Http\Controllers\Pesticide\PesticideController::class, 'index'])->name('pesticide.index');
Route::get('pesticide/{pesticide}', [App\Http\Controllers\Pesticide\PesticideController::class,'show'])->name('pesticide.show');
Route::get('pesticide/{pesticide}/edit', [App\Http\Controllers\Pesticide\PesticideController::class,'edit'])->name('pesticide.edit');
Route::patch('pesticide/{pesticide}', [App\Http\Controllers\Pesticide\PesticideController::class,'update'])->name('pesticide.update');
Route::delete('pesticide/{pesticide}', [App\Http\Controllers\Pesticide\PesticideController::class,'destroy'])->name('pesticide.destroy');

Route::get('join/{crop_id},{desease_id}', [App\Http\Controllers\Join\JoinController::class, 'join_crop_disease'])->name('join');
Route::get('locate_diseasesAScrop/{crop_id}', [App\Http\Controllers\Join\JoinController::class, 'locate_diseasesAScrop'])->name('locate_diseasesAScrop');

//================  Auxiliares ======================

Route::get('crop_variety/create', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'create'])->name('crop_variety.create'); 
Route::post('crop_variety/store', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class, 'store'])->name('crop_variety.store');
Route::get('crop_variety/index', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class, 'index'])->name('crop_variety.index');
Route::get('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'show'])->name('crop_variety.show');
Route::get('crop_variety/{crop_variety}/edit', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'edit'])->name('crop_variety.edit');
Route::patch('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'update'])->name('crop_variety.update');
Route::delete('crop_variety/{crop_variety}', [App\Http\Controllers\Auxiliaries\Crop_varietyController::class,'destroy'])->name('crop_variety.destroy');

Route::get('agronomicClass/create', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class,'create'])->name('agronomicClass.create'); 
Route::post('agronomicClass/store', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class, 'store'])->name('agronomicClass.store');
Route::get('agronomicClass/index', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class, 'index'])->name('agronomicClass.index');
Route::get('agronomicClass/{agronomicClass}', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class,'show'])->name('agronomicClass.show');
Route::get('agronomicClass/{agronomicClass}/edit', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class,'edit'])->name('agronomicClass.edit');
Route::patch('agronomicClass/{agronomicClass}', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class,'update'])->name('agronomicClass.update');
Route::delete('agronomicClass/{agronomicClass}', [App\Http\Controllers\Auxiliaries\AgronomicClassController::class,'destroy'])->name('agronomicClass.destroy');
 
Route::get('formulationType/create', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class,'create'])->name('formulationType.create'); 
Route::post('formulationType/store', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class, 'store'])->name('formulationType.store');
Route::get('formulationType/index', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class, 'index'])->name('formulationType.index');
Route::get('formulationType/{formulationType}', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class,'show'])->name('formulationType.show');
Route::get('formulationType/{formulationType}/edit', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class,'edit'])->name('formulationType.edit');
Route::patch('formulationType/{formulationType}', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class,'update'])->name('formulationType.update');
Route::delete('formulationType/{formulationType}', [App\Http\Controllers\Auxiliaries\FormulationTypeController::class,'destroy'])->name('formulationType.destroy');

Route::get('manufacturer/create', [App\Http\Controllers\Auxiliaries\ManufacturerController::class,'create'])->name('manufacturer.create'); 
Route::post('manufacturer/store', [App\Http\Controllers\Auxiliaries\ManufacturerController::class, 'store'])->name('manufacturer.store');
Route::get('manufacturer/index', [App\Http\Controllers\Auxiliaries\ManufacturerController::class, 'index'])->name('manufacturer.index');
Route::get('manufacturer/{manufacturer}', [App\Http\Controllers\Auxiliaries\ManufacturerController::class,'show'])->name('manufacturer.show');
Route::get('manufacturer/{manufacturer}/edit', [App\Http\Controllers\Auxiliaries\ManufacturerController::class,'edit'])->name('manufacturer.edit');
Route::patch('manufacturer/{manufacturer}', [App\Http\Controllers\Auxiliaries\ManufacturerController::class,'update'])->name('manufacturer.update');
Route::delete('manufacturer/{manufacturer}', [App\Http\Controllers\Auxiliaries\ManufacturerController::class,'destroy'])->name('manufacturer.destroy');

Route::get('applicationMode/create', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class,'create'])->name('applicationMode.create'); 
Route::post('applicationMode/store', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class, 'store'])->name('applicationMode.store');
Route::get('applicationMode/index', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class, 'index'])->name('applicationMode.index');
Route::get('applicationMode/{applicationMode}', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class,'show'])->name('applicationMode.show');
Route::get('applicationMode/{applicationMode}/edit', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class,'edit'])->name('applicationMode.edit');
Route::patch('applicationMode/{applicationMode}', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class,'update'])->name('applicationMode.update');
Route::delete('applicationMode/{applicationMode}', [App\Http\Controllers\Auxiliaries\ApplicationModeController::class,'destroy'])->name('applicationMode.destroy');

Route::get('toxicologicalClass/create', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class,'create'])->name('toxicologicalClass.create'); 
Route::post('toxicologicalClass/store', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class, 'store'])->name('toxicologicalClass.store');
Route::get('toxicologicalClass/index', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class, 'index'])->name('toxicologicalClass.index');
Route::get('toxicologicalClass/{toxicologicalClass}', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class,'show'])->name('toxicologicalClass.show');
Route::get('toxicologicalClass/{toxicologicalClass}/edit', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class,'edit'])->name('toxicologicalClass.edit');
Route::patch('toxicologicalClass/{toxicologicalClass}', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class,'update'])->name('toxicologicalClass.update');
Route::delete('toxicologicalClass/{toxicologicalClass}', [App\Http\Controllers\Auxiliaries\ToxicologicalClassController::class,'destroy'])->name('toxicologicalClass.destroy');

Route::get('chemicalGroup/create', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class,'create'])->name('chemicalGroup.create'); 
Route::post('chemicalGroup/store', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class, 'store'])->name('chemicalGroup.store');
Route::get('chemicalGroup/index', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class, 'index'])->name('chemicalGroup.index');
Route::get('chemicalGroup/{chemicalGroup}', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class,'show'])->name('chemicalGroup.show');
Route::get('chemicalGroup/{chemicalGroup}/edit', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class,'edit'])->name('chemicalGroup.edit');
Route::patch('chemicalGroup/{chemicalGroup}', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class,'update'])->name('chemicalGroup.update');
Route::delete('chemicalGroup/{chemicalGroup}', [App\Http\Controllers\Auxiliaries\ChemicalGroupController::class,'destroy'])->name('chemicalGroup.destroy');

Route::get('actionSite/create', [App\Http\Controllers\Auxiliaries\ActionSiteController::class,'create'])->name('actionSite.create'); 
Route::post('actionSite/store', [App\Http\Controllers\Auxiliaries\ActionSiteController::class, 'store'])->name('actionSite.store');
Route::get('actionSite/index', [App\Http\Controllers\Auxiliaries\ActionSiteController::class, 'index'])->name('actionSite.index');
Route::get('actionSite/{actionSite}', [App\Http\Controllers\Auxiliaries\ActionSiteController::class,'show'])->name('actionSite.show');
Route::get('actionSite/{actionSite}/edit', [App\Http\Controllers\Auxiliaries\ActionSiteController::class,'edit'])->name('actionSite.edit');
Route::patch('actionSite/{actionSite}', [App\Http\Controllers\Auxiliaries\ActionSiteController::class,'update'])->name('actionSite.update');
Route::delete('actionSite/{actionSite}', [App\Http\Controllers\Auxiliaries\ActionSiteController::class,'destroy'])->name('actionSite.destroy');

Route::get('modeOperation/create', [App\Http\Controllers\Auxiliaries\ModeOperationController::class,'create'])->name('modeOperation.create'); 
Route::post('modeOperation/store', [App\Http\Controllers\Auxiliaries\ModeOperationController::class, 'store'])->name('modeOperation.store');
Route::get('modeOperation/index', [App\Http\Controllers\Auxiliaries\ModeOperationController::class, 'index'])->name('modeOperation.index');
Route::get('modeOperation/{modeOperation}', [App\Http\Controllers\Auxiliaries\ModeOperationController::class,'show'])->name('modeOperation.show');
Route::get('modeOperation/{modeOperation}/edit', [App\Http\Controllers\Auxiliaries\ModeOperationController::class,'edit'])->name('modeOperation.edit');
Route::patch('modeOperation/{modeOperation}', [App\Http\Controllers\Auxiliaries\ModeOperationController::class,'update'])->name('modeOperation.update');
Route::delete('modeOperation/{modeOperation}', [App\Http\Controllers\Auxiliaries\ModeOperationController::class,'destroy'])->name('modeOperation.destroy');

Route::get('actuationMechanism/create', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class,'create'])->name('actuationMechanism.create'); 
Route::post('actuationMechanism/store', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class, 'store'])->name('actuationMechanism.store');
Route::get('actuationMechanism/index', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class, 'index'])->name('actuationMechanism.index');
Route::get('actuationMechanism/{actuationMechanism}', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class,'show'])->name('actuationMechanism.show');
Route::get('actuationMechanism/{actuationMechanism}/edit', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class,'edit'])->name('actuationMechanism.edit');
Route::patch('actuationMechanism/{actuationMechanism}', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class,'update'])->name('actuationMechanism.update');
Route::delete('actuationMechanism/{actuationMechanism}', [App\Http\Controllers\Auxiliaries\ActuationMechanismController::class,'destroy'])->name('actuationMechanism.destroy');


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

  

  