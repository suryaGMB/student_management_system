<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Logout;
use App\Livewire\ForgotPassword;
use App\Livewire\CollegeForm;
use App\Livewire\BatchForm;
use App\Livewire\CourseForm;
use App\Livewire\CourseSelection;
use App\Livewire\CourseSelectionForm;
use App\Livewire\DepartmentForm;
use App\Livewire\SectionForm;
use App\Livewire\StudentForm;
use App\Livewire\UserLogin;


use App\Livewire\UserDashboard;

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

// Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

// });

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/logout', Logout::class)->name('logout');
    Route::get('/college', CollegeForm::class)->name('college.form');

    Route::get('/batch', BatchForm::class)->name('batch.form');

    Route::get('/department', DepartmentForm::class)->name('Department.form');


    Route::get('/section', SectionForm::class)->name('Section.form');

    Route::get('/course', CourseForm::class)->name('Course.form');

    Route::get('/student', StudentForm::class)->name('Student.form');

    Route::get('/course-selection', CourseSelectionForm::class)->name('Courseselection.form');

    

});

Route::get('/userlogin', UserLogin::class)->name('user.login');

Route::group(['middleware' => 'auth'], function () {
    // Other routes for authenticated users here

    Route::get('/userdashboard', UserDashboard::class)->name('user.dashboard');
});