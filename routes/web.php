<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessLineController;
use App\Http\Controllers\Admin\CategoryAreaController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentCompanyController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HasRoleAdminMiddleware;
use App\Http\Middleware\HasRoleUserMiddleware;

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

    // Route User
    Route::middleware(HasRoleUserMiddleware::class)->group(function () {
        Route::get('/', [HomeController::class, 'information'])->name('information');
        Route::get('form', [FormController::class, 'index'])->name('form.index');
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::get('presentation', [PresentationController::class, 'presentation'])->name('presentation');
        Route::post('presentation', [PresentationController::class, 'presentationAct'])->name('presentationAct');

        Route::get('form/management-relationship', [FormController::class, 'managementRelationship'])->name('form.managementRelationship');
        Route::post('form/management-relationship', [FormController::class, 'managementRelationshipAct'])->name('form.managementRelationshipAct');
        Route::get('form/relationship', [FormController::class, 'relationship'])->name('form.relationship');
        Route::post('form/relationship', [FormController::class, 'relationshipAct'])->name('form.relationshipAct');
        Route::get('form/program', [FormController::class, 'program'])->name('form.program');
        Route::post('form/program', [FormController::class, 'programAct'])->name('form.programAct');
        Route::get('form/administration', [FormController::class, 'administration'])->name('form.administration');
        Route::post('form/administration', [FormController::class, 'administrationAct'])->name('form.administrationAct');
        Route::get('form/infrastructure', [FormController::class, 'infrastructure'])->name('form.infrastructure');
        Route::post('form/infrastructure', [FormController::class, 'infrastructureAct'])->name('form.infrastructureAct');

        Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    });

    // Route Admin
    Route::middleware(HasRoleAdminMiddleware::class)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryAreaController::class, 'index'])->name('category.index');
            Route::post('/', [CategoryAreaController::class, 'store'])->name('category.store');
            Route::delete('{category}', [CategoryAreaController::class, 'destroy'])->name('category.destroy');
            Route::get('create', [CategoryAreaController::class, 'create'])->name('category.create');
            Route::put('{category}', [CategoryAreaController::class, 'update'])->name('category.update');
            Route::get('{category}/edit', [CategoryAreaController::class, 'edit'])->name('category.edit');
        });

        Route::prefix('province')->group(function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
            Route::post('/', [ProvinceController::class, 'store'])->name('province.store');
            Route::delete('{province}', [ProvinceController::class, 'destroy'])->name('province.destroy');
            Route::get('create', [ProvinceController::class, 'create'])->name('province.create');
            Route::put('{province}', [ProvinceController::class, 'update'])->name('province.update');
            Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
        });

        Route::prefix('company')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('company.index');
            Route::post('/', [CompanyController::class, 'store'])->name('company.store');
            Route::delete('{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
            Route::get('create', [CompanyController::class, 'create'])->name('company.create');
            Route::put('{company}', [CompanyController::class, 'update'])->name('company.update');
            Route::get('{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
        });

        Route::prefix('parent-company')->group(function () {
            Route::get('/', [ParentCompanyController::class, 'index'])->name('parent_company.index');
            Route::post('/', [ParentCompanyController::class, 'store'])->name('parent_company.store');
            Route::get('create', [ParentCompanyController::class, 'create'])->name('parent_company.create');
            Route::delete('{parentCompany}', [ParentCompanyController::class, 'destroy'])->name('parent_company.destroy');
            Route::put('{parentCompany}', [ParentCompanyController::class, 'update'])->name('parent_company.update');
            Route::get('{parentCompany}/edit', [ParentCompanyController::class, 'edit'])->name('parent_company.edit');
        });

        Route::prefix('business-line')->group(function () {
            Route::get('/', [BusinessLineController::class, 'index'])->name('business_line.index');
            Route::post('/', [BusinessLineController::class, 'store'])->name('business_line.store');
            Route::delete('{businessLine}', [BusinessLineController::class, 'destroy'])->name('business_line.destroy');
            Route::get('create', [BusinessLineController::class, 'create'])->name('business_line.create');
            Route::put('{businessLine}', [BusinessLineController::class, 'update'])->name('business_line.update');
            Route::get('{businessLine}/edit', [BusinessLineController::class, 'edit'])->name('business_line.edit');
        });
    });
});
