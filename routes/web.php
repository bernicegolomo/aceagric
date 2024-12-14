<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdministratorController;

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

Route::get('/',[WebsiteController::class,'index'])->name('index');
Route::get('/contact-us',[WebsiteController::class,'contactus'])->name('contactus');
Route::get('/our-gallery',[WebsiteController::class,'gallery'])->name('gallery');
Route::get('/carrers',[WebsiteController::class,'carrers'])->name('carrers');
Route::get('/projects',[WebsiteController::class,'projects'])->name('projects');


Auth::routes();
Route::post('/login_process',[LoginController::class, 'login_process'])->name('login_process')->middleware(['guest']);
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->name('user.')->group(function (){
    Route::get('/dashboard',[AdministratorController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',[AdministratorController::class, 'users'])->name('users');
    Route::get('/deleteuser/{id}',[AdministratorController::class, 'deleteuser'])->name('deleteuser');    
    Route::post('/createadministrator',[AdministratorController::class, 'createadministrator'])->name('createadministrator');


    Route::any('/banners',[AdministratorController::class, 'banners'])->name('banners');    
    Route::get('/deletebanner/{id}',[AdministratorController::class, 'deletebanner'])->name('deletebanner');    
    

    Route::any('/allcareers',[AdministratorController::class, 'careers'])->name('careers');    
    Route::any('/addcareer/{id}',[AdministratorController::class, 'addcareer'])->name('addcareer');    
    Route::any('/addcareer',[AdministratorController::class, 'addcareer'])->name('addcareer');    
    Route::get('/deletecareer/{id}',[AdministratorController::class, 'deletecareer'])->name('deletecareer');    
    Route::get('/deleteprojectimage/{id}',[AdministratorController::class, 'deleteprojectimage'])->name('deleteprojectimage');    


    Route::any('/allprojects',[AdministratorController::class, 'projects'])->name('projects');    
    Route::any('/addproject/{id}',[AdministratorController::class, 'addproject'])->name('addproject');    
    Route::any('/addproject',[AdministratorController::class, 'addproject'])->name('addcareer');    
    Route::get('/deleteproject/{id}',[AdministratorController::class, 'deleteproject'])->name('deleteproject');    
    

    Route::get('/cms',[AdministratorController::class, 'cms'])->name('cms');
    Route::any('/addcms/{id}',[AdministratorController::class, 'addcms'])->name('addcms');    
    Route::any('/addcms',[AdministratorController::class, 'addcms'])->name('addcms');    
    
    Route::any('/gallery',[AdministratorController::class, 'gallery'])->name('gallery');    
    Route::get('/deletegallery/{id}',[AdministratorController::class, 'deletegallery'])->name('deletegallery');    
    

    Route::get('/services',[AdministratorController::class, 'services'])->name('services');
    Route::any('/addservice/{id}',[AdministratorController::class, 'addservice'])->name('addservice');    
    Route::any('/addservice',[AdministratorController::class, 'addservice'])->name('addservice');    
    Route::get('/deleteservice/{id}',[AdministratorController::class, 'deleteservice'])->name('deleteservice');    
    Route::get('/deleteservicecontent/{id}',[AdministratorController::class, 'deleteservicecontent'])->name('deleteservicecontent');    
    

    Route::get('/our-team',[AdministratorController::class, 'teams'])->name('teams');
    Route::any('/addteam/{id}',[AdministratorController::class, 'addteam'])->name('addteam');    
    Route::any('/addteam',[AdministratorController::class, 'addteam'])->name('addteam');    
    Route::get('/deleteteam/{id}',[AdministratorController::class, 'deleteteam'])->name('deleteteam'); 
    


    Route::get('/blogs',[AdministratorController::class, 'manageblogs'])->name('manageblogs'); 
    Route::any('/addblog',[AdministratorController::class, 'addblog'])->name('addblog');
    Route::any('/addblog/{id}',[AdministratorController::class, 'addblog'])->name('addblog');
    Route::get('/deleteblog/{id}',[AdministratorController::class, 'deleteblog'])->name('deleteblog');    
    Route::get('/deactivateblog/{id}',[AdministratorController::class, 'deactivateblog'])->name('deactivateblog');    
    Route::get('/activateblog/{id}',[AdministratorController::class, 'activateblog'])->name('activateblog');    
    Route::get('/deleteblogimage/{id}',[AdministratorController::class, 'deleteblogimage'])->name('deleteblogimage');    
    
    Route::get('/products',[AdministratorController::class, 'products'])->name('products');
    Route::get('/deleteproduct/{id}',[AdministratorController::class, 'deleteproduct'])->name('deleteproduct');    
    Route::any('/addproduct',[AdministratorController::class, 'addproduct'])->name('addproduct');    
    Route::any('/addproduct/{id}',[AdministratorController::class, 'addproduct'])->name('addproduct');    
    Route::any('/activateproduct/{id}',[AdministratorController::class, 'activateproduct'])->name('activateproduct');    
    Route::any('/deactivateproduct/{id}',[AdministratorController::class, 'deactivateproduct'])->name('deactivateproduct');


    Route::get('/testimonials',[AdministratorController::class, 'testimonials'])->name('testimonials');
    Route::get('/deletetestimonial/{id}',[AdministratorController::class, 'deletetestimonial'])->name('deletetestimonial');    
    Route::any('/addtestimonial',[AdministratorController::class, 'addtestimonial'])->name('addtestimonial');    
    Route::any('/addtestimonial/{id}',[AdministratorController::class, 'addtestimonial'])->name('addtestimonial');    
    Route::any('/activatetestimonial/{id}',[AdministratorController::class, 'activatetestimonial'])->name('activatetestimonial');    
    Route::any('/deactivatetestimonial/{id}',[AdministratorController::class, 'deactivatetestimonial'])->name('deactivatetestimonial');

    Route::get('/ournumbers',[AdministratorController::class, 'ournumbers'])->name('ournumbers');
    Route::get('/deleteournumber/{id}',[AdministratorController::class, 'deleteournumber'])->name('deleteournumber');    
    Route::any('/addnumber',[AdministratorController::class, 'addournumber'])->name('addournumber');    
    Route::any('/addnumber/{id}',[AdministratorController::class, 'addournumber'])->name('addournumber');    
    

    
    Route::get('/newsletters',[AdministratorController::class, 'newsletters'])->name('newsletters');
    Route::get('/orders',[AdministratorController::class, 'orders'])->name('orders');
    Route::get('/processorder/{id}',[AdministratorController::class, 'processorder'])->name('processorder');
});

