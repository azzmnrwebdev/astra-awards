<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessLineController;
use App\Http\Controllers\Admin\CategoryAreaController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JuryContainer;
use App\Http\Controllers\Admin\ParentCompanyController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRolesMiddleware;
use App\Http\Middleware\CheckStatusMiddleware;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'loginAct'])->name('loginAct');
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register', [RegisterController::class, 'registerAct'])->name('registerAct');
    Route::get('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPasswordAct'])->name('forgotPasswordAct');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPasswordAct'])->name('resetPasswordAct');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    // Route All Role
    Route::middleware([CheckStatusMiddleware::class])->group(function () {
        Route::get('/', [HomeController::class, 'information'])->name('information');
        Route::get('formulir', [FormController::class, 'index'])->name('form.index');
        Route::get('formulir/manajemen-hubungan', [FormController::class, 'managementRelationship'])->name('form.managementRelationship');
        Route::get('formulir/hubungan', [FormController::class, 'relationship'])->name('form.relationship');
        Route::get('formulir/program', [FormController::class, 'program'])->name('form.program');
        Route::get('formulir/administrasi', [FormController::class, 'administration'])->name('form.administration');
        Route::get('formulir/infrastruktur', [FormController::class, 'infrastructure'])->name('form.infrastructure');
        Route::get('presentasi', [PresentationController::class, 'presentation'])->name('presentation');
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    });

    // Route Only User
    Route::middleware([CheckRolesMiddleware::class . ':user'])->group(function () {
        Route::post('formulir/manajemen-hubungan', [FormController::class, 'managementRelationshipAct'])->name('form.managementRelationshipAct');
        Route::post('formulir/hubungan', [FormController::class, 'relationshipAct'])->name('form.relationshipAct');
        Route::post('presentasi', [PresentationController::class, 'presentationAct'])->name('presentationAct');
        Route::post('formulir/program', [FormController::class, 'programAct'])->name('form.programAct');
        Route::post('formulir/administrasi', [FormController::class, 'administrationAct'])->name('form.administrationAct');
        Route::post('formulir/infrastruktur', [FormController::class, 'infrastructureAct'])->name('form.infrastructureAct');
    });

    // Route Admin & Jury
    Route::middleware([CheckRolesMiddleware::class . ':admin,jury'])->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('/', [DashboardController::class, 'dashboardAct'])->name('dashboardAct');

        Route::get('profil-saya', [AdminProfileController::class, 'index'])->name('dashboard_profile.index');
        Route::get('profil-saya/edit-profil', [AdminProfileController::class, 'edit'])->name('dashboard_profile.edit');
        Route::post('profil-saya/perbarui-profil', [AdminProfileController::class, 'update'])->name('dashboard_profile.update');
        Route::get('profil-saya/edit-password', [AdminProfileController::class, 'editPassword'])->name('dashboard_profile.edit_pass');
        Route::post('profil-saya/perbarui-password', [AdminProfileController::class, 'updatePassword'])->name('dashboard_profile.update_pass');

        Route::prefix('juri')->group(function () {
            Route::get('/', [JuryContainer::class, 'index'])->name('jury.index');
            Route::get('tambah', [JuryContainer::class, 'create'])->name('jury.create');
            Route::post('/', [JuryContainer::class, 'store'])->name('jury.store');
            Route::get('{jury}/edit', [JuryContainer::class, 'edit'])->name('jury.edit');
            Route::put('{jury}', [JuryContainer::class, 'update'])->name('jury.update');
            Route::delete('{jury}', [JuryContainer::class, 'destroy'])->name('jury.destroy');
        });
    });

    // Route Admin
    Route::middleware([CheckRolesMiddleware::class . ':admin'])->prefix('dashboard')->group(function () {
        Route::prefix('kategori')->group(function () {
            Route::get('/', [CategoryAreaController::class, 'index'])->name('category.index');
            Route::get('tambah', [CategoryAreaController::class, 'create'])->name('category.create');
            Route::post('/', [CategoryAreaController::class, 'store'])->name('category.store');
            Route::get('{category}/edit', [CategoryAreaController::class, 'edit'])->name('category.edit');
            Route::put('{category}', [CategoryAreaController::class, 'update'])->name('category.update');
            Route::delete('{category}', [CategoryAreaController::class, 'destroy'])->name('category.destroy');
        });

        Route::prefix('provinsi')->group(function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
            Route::get('tambah', [ProvinceController::class, 'create'])->name('province.create');
            Route::post('/', [ProvinceController::class, 'store'])->name('province.store');
            Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
            Route::put('{province}', [ProvinceController::class, 'update'])->name('province.update');
            Route::delete('{province}', [ProvinceController::class, 'destroy'])->name('province.destroy');
        });

        Route::prefix('perusahaan')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('company.index');
            Route::get('tambah', [CompanyController::class, 'create'])->name('company.create');
            Route::post('/', [CompanyController::class, 'store'])->name('company.store');
            Route::get('{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
            Route::put('{company}', [CompanyController::class, 'update'])->name('company.update');
            Route::delete('{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
        });

        Route::prefix('induk-perusahaan')->group(function () {
            Route::get('/', [ParentCompanyController::class, 'index'])->name('parent_company.index');
            Route::get('tambah', [ParentCompanyController::class, 'create'])->name('parent_company.create');
            Route::post('/', [ParentCompanyController::class, 'store'])->name('parent_company.store');
            Route::get('{parentCompany}/edit', [ParentCompanyController::class, 'edit'])->name('parent_company.edit');
            Route::put('{parentCompany}', [ParentCompanyController::class, 'update'])->name('parent_company.update');
            Route::delete('{parentCompany}', [ParentCompanyController::class, 'destroy'])->name('parent_company.destroy');
        });

        Route::prefix('lini-bisnis')->group(function () {
            Route::get('/', [BusinessLineController::class, 'index'])->name('business_line.index');
            Route::get('tambah', [BusinessLineController::class, 'create'])->name('business_line.create');
            Route::post('/', [BusinessLineController::class, 'store'])->name('business_line.store');
            Route::get('{businessLine}/edit', [BusinessLineController::class, 'edit'])->name('business_line.edit');
            Route::put('{businessLine}', [BusinessLineController::class, 'update'])->name('business_line.update');
            Route::delete('{businessLine}', [BusinessLineController::class, 'destroy'])->name('business_line.destroy');
        });

        Route::prefix('panitia')->group(function () {
            Route::get('/', [CommitteeController::class, 'index'])->name('committee.index');
            Route::get('tambah', [CommitteeController::class, 'create'])->name('committee.create');
            Route::post('/', [CommitteeController::class, 'store'])->name('committee.store');
            Route::get('{committee}/edit', [CommitteeController::class, 'edit'])->name('committee.edit');
            Route::put('{committee}', [CommitteeController::class, 'update'])->name('committee.update');
            Route::delete('{committee}', [CommitteeController::class, 'destroy'])->name('committee.destroy');
        });

        Route::prefix('peserta-dkm')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('{user}', [UserController::class, 'show'])->name('user.show');
            Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('{user}', [UserController::class, 'update'])->name('user.update');
            Route::get('{user}/edit-status', [UserController::class, 'editStatus'])->name('user.edit_status');
            Route::put('{user}/update-status', [UserController::class, 'updateStatus'])->name('user.update_status');
            Route::delete('{user}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });
});
