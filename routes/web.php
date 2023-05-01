<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontView\FrontUserViewController;
use App\Http\Controllers\master\CategoryController;
use App\Http\Controllers\master\ShowroomController;
use App\Http\Controllers\master\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('Web/webPageIndex');
// });
Route::get('/', [FrontUserViewController::class, 'index'])->name('webPageIndex');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('login_process');
Route::post('/register_process', [AuthController::class, 'register_process'])->name('register_process');
Route::get('/serachingKeyword/{key}', [FrontUserViewController::class, 'serachingKeyword'])->name('serachingKeyword');
Route::get('/serachingByPostId/{key}', [FrontUserViewController::class, 'serachingByPostId'])->name('serachingByPostId');
Route::post('/serachingKeywordByForm', [FrontUserViewController::class, 'serachingKeywordByForm'])->name('serachingKeywordByForm');
Route::get('/gallery', [FrontUserViewController::class, 'gallery'])->name('gallery');
Route::get('/searchingCategory/{catName}/{key}', [FrontUserViewController::class, 'searchingCategory'])->name('searchingCategory');

Route::view('/detail', 'web/detail');
//POST//test


Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
   

    Route::get('/newPost', [PostController::class, 'newPost'])->name('newPost');
    Route::post('/storePost', [PostController::class, 'storePost'])->name('storePost');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/postOnApproval', [PostController::class, 'postOnApproval'])->name('postOnApproval');
    Route::get('/postOnSchedule', [PostController::class, 'postOnSchedule'])->name('postOnSchedule');
    Route::get('/editApprovalPost/{id}', [PostController::class, 'editApprovalPost'])->name('editApprovalPost');
    Route::get('/editSchedulePost/{id}', [PostController::class, 'editSchedulePost'])->name('editSchedulePost');
    Route::get('/editSitePost/{id}', [PostController::class, 'editSitePost'])->name('editSitePost');
    Route::get('/editExpiredPost/{id}', [PostController::class, 'editExpiredPost'])->name('editExpiredPost');
    Route::post('/updatePost/{id}', [PostController::class, 'updatePost'])->name('updatePost');
    Route::post('/deletePost', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/approvePost', [PostController::class, 'approvePost'])->name('approvePost');
    Route::get('/postOnSite', [PostController::class, 'postOnSite'])->name('postOnSite');
    Route::get('/postOnExpired', [PostController::class, 'postOnExpired'])->name('postOnExpired');
    Route::get('/Permissions', [RolesController::class, 'Permissions'])->name('Permissions');
    Route::get('/addPermission', [RolesController::class, 'addPermission'])->name('addPermission');
    Route::post('/storePermission', [RolesController::class, 'storePermission'])->name('storePermission');
    Route::get('/editPermission/{id}', [RolesController::class, 'editPermission'])->name('editPermission');
    Route::post('/updatePermission/{id}', [RolesController::class, 'updatePermission'])->name('updatePermission');
    Route::post('/deletePermission', [RolesController::class, 'deletePermission'])->name('deletePermission');
    Route::post('getCategoryDetails',[PostController::class, 'getCategoryDetails'])->name('getCategoryDetails');
    Route::post('getCategoryDetailsByIds',[PostController::class, 'getCategoryDetailsByIds'])->name('getCategoryDetailsByIds');
    Route::post('updateCategory',[PostController::class, 'updateCategory'])->name('updateCategory');
    Route::post('getTagDetails',[PostController::class, 'getTagDetails'])->name('getTagDetails');
    Route::post('getTagDetailsByIds',[PostController::class, 'getTagDetailsByIds'])->name('getTagDetailsByIds');
    Route::post('updateTag',[PostController::class, 'updateTag'])->name('updateTag');


    Route::get('/Roles', [RolesController::class, 'Roles'])->name('Roles');
    Route::get('/addRoles', [RolesController::class, 'addRoles'])->name('addRoles');
    Route::post('/storeRoles', [RolesController::class, 'storeRoles'])->name('storeRoles');
    Route::get('/editRoles/{id}', [RolesController::class, 'editRoles'])->name('editRoles');
    Route::post('/updateRoles/{id}', [RolesController::class, 'updateRoles'])->name('updateRoles');
    Route::post('/deleteRoles', [RolesController::class, 'deleteRoles'])->name('deleteRoles');

    Route::get('/users', [UsersController::class, 'users'])->name('users');
    Route::get('/addUser', [UsersController::class, 'addUser'])->name('addUser');
    Route::post('/storeUser', [UsersController::class, 'storeUser'])->name('storeUser');
    Route::get('/editUser/{id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('/updateUser/{id}', [UsersController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser', [UsersController::class, 'deleteUser'])->name('deleteUser');


    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [AuthController::class, 'updateUser'])->name('updateProfile');
    Route::resource('tagMaster', TagController::class);
    Route::post('/deletetagMaster', [TagController::class, 'destroy'])->name('deletetagMaster');
    Route::resource('categoryMaster', CategoryController::class);
    Route::post('/deletecategoryMaster', [CategoryController::class, 'destroy'])->name('deletecategoryMaster');
    Route::resource('showroomMaster', ShowroomController::class);    
    Route::post('/deleteshowroomMaster', [ShowroomController::class, 'destroy'])->name('deleteshowroomMaster');
    // more route definitions
    Route::post('/deletePdf', [PostController::class, 'deletePdf'])->name('deletePdf');
});


