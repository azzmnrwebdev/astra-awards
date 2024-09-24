<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusinessLineController;
use App\Http\Controllers\Admin\CategoryAreaController;
use App\Http\Controllers\Admin\CategoryMosqueController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistributionController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\JuryContainer;
use App\Http\Controllers\Admin\ParentCompanyController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommitteeAssessmentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SystemAssessmentController;
use App\Http\Middleware\CheckRolesMiddleware;
use App\Http\Middleware\CheckStatusMiddleware;
use App\Http\Middleware\FormDKMMiddleware;
use App\Http\Middleware\InitialAssessmentMiddleware;
use App\Http\Middleware\RegisterMiddleware;
use App\Http\Middleware\SelectionMiddleware;

Route::middleware('guest')->group(function () {
    Route::get('masuk', [LoginController::class, 'login'])->name('login');
    Route::post('masuk', [LoginController::class, 'loginAct'])->name('loginAct');
    Route::get('daftar', [RegisterController::class, 'register'])->name('register')->middleware(RegisterMiddleware::class);
    Route::post('daftar', [RegisterController::class, 'registerAct'])->name('registerAct')->middleware(RegisterMiddleware::class);
    Route::get('lupa-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('lupa-password', [ForgotPasswordController::class, 'forgotPasswordAct'])->name('forgotPasswordAct');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPasswordAct'])->name('resetPasswordAct');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    // Route All Role
    Route::middleware([CheckStatusMiddleware::class])->group(function () {
        Route::get('/', [HomeController::class, 'information'])->name('information');

        Route::prefix('pengaturan')->group(function () {
            Route::get('pengaturan', [SettingController::class, 'index'])->name('setting.index');
            Route::get('informasi-akun', [SettingController::class, 'account'])->name('setting.account');
            Route::put('informasi-akun', [SettingController::class, 'accountAct'])->name('setting.accountAct');
            Route::get('informasi-umum', [SettingController::class, 'general'])->name('setting.general');
            Route::put('informasi-umum', [SettingController::class, 'generalAct'])->name('setting.generalAct');
            Route::get('ganti-kata-sandi', [SettingController::class, 'changePassword'])->name('setting.changePassword');
            Route::put('ganti-kata-sandi', [SettingController::class, 'changePasswordAct'])->name('setting.changePasswordAct');
        });
    });

    // Route Jury & User
    Route::middleware([CheckRolesMiddleware::class . ':jury,user', CheckStatusMiddleware::class])->group(function () {
        Route::get('presentasi', [PresentationController::class, 'presentation'])->name('presentation')->middleware([FormDKMMiddleware::class, InitialAssessmentMiddleware::class]);
    });

    // Route Admin & User
    Route::middleware([CheckRolesMiddleware::class . ':admin,user', CheckStatusMiddleware::class])->group(function () {
        Route::get('formulir', [FormController::class, 'index'])->name('form.index')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
        Route::get('formulir/manajemen-hubungan/{user?}/{action?}', [FormController::class, 'managementRelationship'])->name('form.managementRelationship')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
        Route::get('formulir/hubungan/{user?}/{action?}', [FormController::class, 'relationship'])->name('form.relationship')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
        Route::get('formulir/program/{user?}/{action?}', [FormController::class, 'program'])->name('form.program')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
        Route::get('formulir/administrasi/{user?}/{action?}', [FormController::class, 'administration'])->name('form.administration')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
        Route::get('formulir/infrastruktur/{user?}/{action?}', [FormController::class, 'infrastructure'])->name('form.infrastructure')->middleware([FormDKMMiddleware::class, SelectionMiddleware::class]);
    });

    // Route Only User
    Route::middleware([CheckRolesMiddleware::class . ':user'])->group(function () {
        Route::post('formulir/manajemen-hubungan', [FormController::class, 'managementRelationshipAct'])->name('form.managementRelationshipAct')->middleware(FormDKMMiddleware::class);
        Route::post('formulir/hubungan', [FormController::class, 'relationshipAct'])->name('form.relationshipAct')->middleware(FormDKMMiddleware::class);
        Route::post('presentasi', [PresentationController::class, 'presentationAct'])->name('presentationAct')->middleware(FormDKMMiddleware::class);
        Route::post('formulir/program', [FormController::class, 'programAct'])->name('form.programAct')->middleware(FormDKMMiddleware::class);
        Route::post('formulir/administrasi', [FormController::class, 'administrationAct'])->name('form.administrationAct')->middleware(FormDKMMiddleware::class);
        Route::post('formulir/infrastruktur', [FormController::class, 'infrastructureAct'])->name('form.infrastructureAct')->middleware(FormDKMMiddleware::class);
    });

    // Route Admin
    Route::prefix('admin')->middleware([CheckRolesMiddleware::class . ':admin'])->group(function () {
        Route::post('formulir/manajemen-hubungan/{user?}/{action?}/penilaian-sistem', [SystemAssessmentController::class, 'pillarOneAct'])->name('system_assessment.pillarOneAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/hubungan/{user?}/{action?}/penilaian-sistem', [SystemAssessmentController::class, 'pillarTwoAct'])->name('system_assessment.pillarTwoAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/program/{user?}/{action?}/penilaian-sistem', [SystemAssessmentController::class, 'pillarThreeAct'])->name('system_assessment.pillarThreeAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/administrasi/{user?}/{action?}/penilaian-sistem', [SystemAssessmentController::class, 'pillarFourAct'])->name('system_assessment.pillarFourAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/infrastruktur/{user?}/{action?}/penilaian-sistem', [SystemAssessmentController::class, 'pillarFiveAct'])->name('system_assessment.pillarFiveAct')->middleware([SelectionMiddleware::class]);

        Route::post('formulir/manajemen-hubungan/{user?}/{action?}/penilaian-panitia', [CommitteeAssessmentController::class, 'pillarOneAct'])->name('committe_assessment.pillarOneAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/hubungan/{user?}/{action?}/penilaian-panitia', [CommitteeAssessmentController::class, 'pillarTwoAct'])->name('committe_assessment.pillarTwoAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/program/{user?}/{action?}/penilaian-panitia', [CommitteeAssessmentController::class, 'pillarThreeAct'])->name('committe_assessment.pillarThreeAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/administrasi/{user?}/{action?}/penilaian-panitia', [CommitteeAssessmentController::class, 'pillarFourAct'])->name('committe_assessment.pillarFourAct')->middleware([SelectionMiddleware::class]);
        Route::post('formulir/infrastruktur/{user?}/{action?}/penilaian-panitia', [CommitteeAssessmentController::class, 'pillarFiveAct'])->name('committe_assessment.pillarFiveAct')->middleware([SelectionMiddleware::class]);
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
        Route::get('pengguna-berdasarkan-kategori-unduh-pdf/{categoryAreaId}/{categoryMosqueId}', [PDFController::class, 'getUsersByCategory'])->name('download_pdf.get_users_by_category');
        Route::get('pengguna-berdasarkan-provinsi-unduh-pdf/{provinceId}', [PDFController::class, 'getUsersByProvince'])->name('download_pdf.get_users_by_province');
        Route::get('pengguna-berdasarkan-lini-bisnis-unduh-pdf/{businessLineId}', [PDFController::class, 'getUsersByBusinessLine'])->name('download_pdf.get_users_by_business_line');

        Route::get('pengguna-berdasarkan-kategori-unduh-excel/{categoryAreaId}/{categoryMosqueId}', [ExcelController::class, 'getUsersByCategory'])->name('download_excel.get_users_by_category');
        Route::get('pengguna-berdasarkan-provinsi-unduh-excel/{provinceId}', [ExcelController::class, 'getUsersByProvince'])->name('download_excel.get_users_by_province');
        Route::get('pengguna-berdasarkan-lini-bisnis-unduh-excel/{businessLineId}', [ExcelController::class, 'getUsersByBusinessLine'])->name('download_excel.get_users_by_business_line');

        Route::prefix('kategori-area')->group(function () {
            Route::get('/', [CategoryAreaController::class, 'index'])->name('categoryArea.index');
            Route::get('tambah', [CategoryAreaController::class, 'create'])->name('categoryArea.create');
            Route::post('/', [CategoryAreaController::class, 'store'])->name('categoryArea.store');
            Route::get('{categoryArea}/edit', [CategoryAreaController::class, 'edit'])->name('categoryArea.edit');
            Route::put('{categoryArea}', [CategoryAreaController::class, 'update'])->name('categoryArea.update');
            Route::delete('{categoryArea}', [CategoryAreaController::class, 'destroy'])->name('categoryArea.destroy');
        });

        Route::prefix('kategori-masjid')->group(function () {
            Route::get('/', [CategoryMosqueController::class, 'index'])->name('categoryMosque.index');
            Route::get('tambah', [CategoryMosqueController::class, 'create'])->name('categoryMosque.create');
            Route::post('/', [CategoryMosqueController::class, 'store'])->name('categoryMosque.store');
            Route::get('{categoryMosque}/edit', [CategoryMosqueController::class, 'edit'])->name('categoryMosque.edit');
            Route::put('{categoryMosque}', [CategoryMosqueController::class, 'update'])->name('categoryMosque.update');
            Route::delete('{categoryMosque}', [CategoryMosqueController::class, 'destroy'])->name('categoryMosque.destroy');
        });

        Route::prefix('provinsi')->group(function () {
            Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
            Route::get('tambah', [ProvinceController::class, 'create'])->name('province.create');
            Route::post('/', [ProvinceController::class, 'store'])->name('province.store');
            Route::get('{province}', [ProvinceController::class, 'show'])->name('province.show');
            Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
            Route::put('{province}', [ProvinceController::class, 'update'])->name('province.update');
            Route::delete('{province}', [ProvinceController::class, 'destroy'])->name('province.destroy');
        });

        Route::prefix('kota-kabupaten')->group(function () {
            Route::get('/', [CityController::class, 'index'])->name('city.index');
            Route::get('tambah', [CityController::class, 'create'])->name('city.create');
            Route::post('/', [CityController::class, 'store'])->name('city.store');
            Route::get('{city}/edit', [CityController::class, 'edit'])->name('city.edit');
            Route::put('{city}', [CityController::class, 'update'])->name('city.update');
            Route::delete('{city}', [CityController::class, 'destroy'])->name('city.destroy');
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
            Route::post('pembagian-penilaian', [CommitteeController::class, 'distribution'])->name('committee.distribution');
            Route::get('{committee}', [CommitteeController::class, 'show'])->name('committee.show');
            Route::get('{committee}/edit', [CommitteeController::class, 'edit'])->name('committee.edit');
            Route::put('{committee}', [CommitteeController::class, 'update'])->name('committee.update');
            Route::delete('{committee}', [CommitteeController::class, 'destroy'])->name('committee.destroy');
        });

        Route::prefix('peserta')->group(function () {
            Route::get('unduh-excel', [ExcelController::class, 'getAllUsers'])->name('user.download_excel');
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
