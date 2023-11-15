<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponController;
use App\Models\Designation;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;
use App\Events\Message;
use App\Http\Controllers\PusherController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
//     Route::get('/dashboard', [HomeController::class, "dashboardAdmin"])->name('dashboardadmin');
// });

 Route::get('/dashboard', [HomeController::class, "dashboard"])->name('dashboard')->middleware('auth');



Route::middleware(['auth','user-role:Admin'])->group(function()
{
    Route::get('/admin/dashboard', [HomeController::class, "dashboardAdmin"])->name('dashboard.admin');

});

Route::middleware(['auth','user-role:System Analyst'])->group(function()
{
    Route::get('/systemanalyst/dashboard', [HomeController::class, "dashboardanalyst"])->name('dashboard.analyst');

});

Route::middleware(['auth','user-role:System Developer'])->group(function()
{
    Route::get('/systemdeveloper/dashboard', [HomeController::class, "dashboarddeveloper"])->name('dashboard.developer');

});



Route::get('/login', [AuthController::class, "login"])->name('login')->middleware('guest');

Route::post('/', [AuthController::class, "logout"])->name('logout');

Route::post('/login', [AuthController::class, "storeLogin"])->name('store.login')->middleware('guest');

Route::get('/register', [AuthController::class,"register"])->name('register')->middleware('guest');

Route::post('/register', [AuthController::class,"storeRegister"])->name('store.register')->middleware('guest');




Route::get('/createproject', [HomeController::class,"createproject"])->name('create.project')->middleware('auth');



Route::post('/login', [AuthController::class, "storeLogin"])->name('store.login');


// Route::get('/userProfile', [HomeController::class, "userProfile"])->name('user.profile');

Route::get('/profile', [ProfileController::class, "index"])->name('user');

Route::post('/profile/storeProfile/{id}',[ProfileController::class,"storeProfile"])->name('store.profile');

Route::post('/profile/changePassword/{id}',[AuthController::class,"changePassword"])->name('change.password');

//create analyst

Route::get('/createanalyst', [AnalysisController::class,"createanalyst"])->name('create.analyst')->middleware('auth');

Route::post('/submitanalyst/{id}', [AnalysisController::class,"submitanalyst"])->name('submit.analyst')->middleware('auth');

Route::post('/uploadfile',  [AnalysisController::class,"uploadFileTemp"])->name('file.temp');

Route::get('/listanalyst', [AnalysisController::class,"listAnalyst"])->name("list.analyst");

Route::post('/delete',  [AnalysisController::class,"deleteAnalyst"])->name('delete.analyst');




//developer

Route::get('/taskdev', [DeveloperController::class,"taskdev"])->name('taskdev')->middleware('auth');

Route::get('/accept/task/{id}', [DeveloperController::class,"acceptTask"])->name('accept.task')->middleware('auth');

Route::post('/update/rejection/{id}',  [DeveloperController::class,"rejectTask"]);

Route::get('/view/{id}',[DeveloperController::class,"viewAnalyst"])->name('view.analyst');

Route::post('/view',[DeveloperController::class,"viewPDF"])->name('view.pdf');


//chat

Route::post('/view/{id}',[ResponController::class,"chat"])->name('chat.respon');





Route::get('/chat',[PusherController::class,"sendMessage"]);



