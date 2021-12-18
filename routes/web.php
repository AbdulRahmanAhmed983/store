<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Relations\RelationController;
use App\Http\Controllers\CollectTutorial;


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

Route::get('/', function () {
    $data = [];
    $data['name']='juba';
    $data['age']=23;
    return view('welcome',$data);
    // return view('welcome')->with(['name'=>'juba' , "age" => 23]);
});


Route::get("/login",function(){
    return "you must login ";
})->name('login');



// for email stmp
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],function(){
    Route::get('/create',[CrudController::class,'create']);
});

Route::get('/show/{id}',[CrudController::class,'show'])->name('showoffer');
Route::post('/offers',[CrudController::class,'store'])->name('offers');
Route::get('/edit/{id}',[CrudController::class,'edit'])->name('offerEdit');
Route::post('/update/{id}',[CrudController::class,'update'])->name('offerUpdate');  
Route::get('/delete/{id}',[CrudController::class,'delete'])->name('offerdelete');
Route::get('/index',[CrudController::class,'index'])->name('index');

Route::get('/youtube',[CrudController::class,'getVideo']);
Route::group(['middleware' => 'CheckAge'],function(){

    Route::get('Adualts',[CustomAuthController::class,'Adualt'])->name('adualt');
});
Route::get('/notadualt',function(){
    return 'not Adualt';
})->name('notadualt');

Route::get('/site',[CustomAuthController::class,'site'])->name('site')->middleware('auth:web');
 Route::get('adminPanel',[CustomAuthController::class,'adminPanel'])->middleware('auth:admin')->name('adminPanel');
 Route::get('/admin/login',[CustomAuthController::class,'adminLogin'])->name('admin.login');
Route::post('/admin/login',[CustomAuthController::class,'checkadmin'])->name('save.admin');

########################## Start Relation ##########################################################
Route::get('/test-relations',[RelationController::class,'hasOneRelation']);
Route::get('/test-relations-reverse',[RelationController::class,'hasOneRelationReverse']);
Route::get('/user-has-phone',[RelationController::class,'getUserhasPhone']);
Route::get('/user-has-phone-withCondation',[RelationController::class,'condation']);
###############################################################################################
Route::get('/hospital-has-many',[RelationController::class,'getHospitalDoctor']);
Route::get('/hospitals',[RelationController::class,'Hospitals']);
Route::get('/hospitals/{hospital_id}',[RelationController::class,'deleteHospitals'])->name('delete.hospital');
Route::get('/Doctors/{hospital_id}',[RelationController::class,'Doctors'])->name('hospital.doctors');
Route::get('/hospitals-doctor',[RelationController::class,'HospitalsHasDoctor']);
Route::get('/hospitals-hasnt-male-doctor',[RelationController::class,'HospitalsHasntMale']);
############################################################################################################
Route::get('doctor/service',[RelationController::class,'doctorService']);
Route::get('service/doctor',[RelationController::class,'serviceDoctor']);
Route::get('showService/{doctor_id}',[RelationController::class,'showService'])->name('show.special');
Route::get('/Doctors-delete/{doctor_id}',[RelationController::class,'deleteDoctors'])->name('delete.doctor');
Route::post('/SaveServicesToDoctors',[RelationController::class,'SaveServices'])->name('save.servie');
###########################################################################################################
##############hasOneThrough##############################
Route::get('/has-one-through',[RelationController::class,'getPatientDoctor']);
Route::get('/has-many-through',[RelationController::class,'getCountryDoctor']);
########################## End Relation ##########################################################

Route::get('/testCollection',[CollectTutorial::class,'testCollection']);





