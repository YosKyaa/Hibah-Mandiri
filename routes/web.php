<?php

use App\Http\Controllers\AddReviewerController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\FinalisasiDanaController;
use App\Http\Controllers\LoaController;
use App\Http\Controllers\MonevController;
use App\Http\Controllers\NotificationAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserAnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\UserProposalController;
use App\Http\Controllers\ViceRector1Controller;
use App\Http\Controllers\ViceRector2Controller;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
})->name('index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi')->middleware('auth');

Route::group(['prefix' => 'announcements'], function () {
    Route::any('/', [AnnouncementController::class, 'index'])->name('announcements.index')->middleware('auth');
    Route::get('/data', [AnnouncementController::class, 'data'])->name('announcements.data');
    Route::delete('/delete', [AnnouncementController::class, 'delete'])->name('announcements.delete');
    Route::get('/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/update/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
});

Route::group(['prefix' => 'user-announcements'], function () {
    Route::any('/', [UserAnnouncementController::class, 'index'])->name('user-announcements.index')->middleware('auth');
});


Route::group(['prefix' => 'user-proposals'], function () {
    Route::any('/', [UserProposalController::class, 'index'])->name('user-proposals.index')->middleware('auth');
    Route::get('/data', [UserProposalController::class, 'data'])->name('user-proposals.data');
    Route::any('/create', [UserProposalController::class, 'create'])->name('user-proposals.create');
    Route::any('/timeline', [UserProposalController::class, 'timeline'])->name('user-proposals.timeline');
    Route::delete('/delete', [UserProposalController::class, 'delete'])->name('user-proposals.delete');
    Route::any('/show/{id}', [UserProposalController::class, 'show'])->name('user-proposals.show');
    Route::get('/edit/{id}', [UserProposalController::class, 'edit'])->name('user-proposals.edit');
    Route::put('/update/{id}', [UserProposalController::class, 'update'])->name('user-proposals.update');
    Route::get('/category/by_id', [UserProposalController::class, 'category_by_id'])->name('DOC.get_category_by_id');
    Route::get('/research_type_funds/{researchtypesId}', [UserProposalController::class, 'getResearchTypeFunds'])->name('get_research_type_funds');
    Route::post('/approve', [UserProposalController::class, 'approve'])->name('user-proposals.approve');
    Route::post('/mark_as_revised_1', [UserProposalController::class, 'mark_as_revised_1'])->name('user-proposals.mark_as_revised_1');
    Route::post('/mark_as_revised_2', [UserProposalController::class, 'mark_as_revised_2'])->name('user-proposals.mark_as_revised_2');
    Route::get('/print_pdf/{id}', [UserProposalController::class, 'print_pdf'])->name('print_pdf');
    Route::get('/print_loa/{id}', [UserProposalController::class, 'print_loa'])->name('print_loa');
    Route::get('/account-bank/{id}', [UserProposalController::class, 'account_bank'])->name('user-proposals-account-bank.edit');
    Route::put('/account-bank-update/{id}', [UserProposalController::class, 'account_bank_update'])->name('user-proposals-account-bank.update');
    Route::get('/monev/{id}', [UserProposalController::class, 'monev'])->name('user-proposals-monev.edit');
    Route::put('/monev-update/{id}', [UserProposalController::class, 'monev_update'])->name('user-proposals-monev.update');
    Route::get('final-report/{id}', [UserProposalController::class, 'final_report'])->name('user-proposals-final-report.edit');
    Route::put('final-report-update/{id}', [UserProposalController::class, 'final_report_update'])->name('user-proposals-final-report.update');
});


Route::get('/get_research_themes_by_id', [UserProposalController::class, 'getResearchThemeById'])->name('DOC.get_research_themes_by_id');
Route::get('/get_research_topics_by_id', [UserProposalController::class, 'getResearchTopicById'])->name('DOC.get_research_topics_by_id');
Route::get('/get_tkt_types_by_id', [UserProposalController::class, 'getTktTypesById'])->name('DOC.get_tkt_types_by_id');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/total-null-reviewers', [NotificationAdminController::class, 'getTotalNullReviewers'])->name('getTotalNullReviewers');
    Route::get('/totalS05Proposals', [NotificationAdminController::class, 'getTotalS05Proposals'])->name('getTotalS05Proposals');
    Route::get('/total-null-admin-fund-finalization', [NotificationAdminController::class, 'getTotalNullAdminFundFinalization'])->name('getTotalNullAdminFundFinalization');


    Route::group(['prefix' => 'proposals'], function () { //manage admin proposal
        Route::any('/', [ProposalController::class, 'index'])->name('proposals.index')->middleware('auth');
        Route::get('/data', [ProposalController::class, 'data'])->name('proposals.data');
        Route::any('/show/{id}', [ProposalController::class, 'show'])->name('user-proposals.show');
    });

    Route::group(['prefix' => 'addreviewer'], function () { //Presentasi
        Route::any('/', [AddReviewerController::class, 'index'])->name('addreviewer.index')->middleware('auth');
        Route::get('/data', [AddReviewerController::class, 'data'])->name('addreviewer.data');
        Route::delete('/delete', [AddReviewerController::class, 'delete'])->name('addreviewer.delete');
        Route::get('/edit/{id}', [AddReviewerController::class, 'edit'])->name('addreviewer.edit');
        Route::put('/update/{id}', [AddReviewerController::class, 'update'])->name('addreviewer.update');
    });

    Route::group(['prefix' => 'presentation'], function () { //Presentasi
        Route::any('/', [PresentasiController::class, 'index'])->name('presentation.index')->middleware('auth');
        Route::get('/data', [PresentasiController::class, 'data'])->name('presentation.data');
        Route::delete('/delete', [PresentasiController::class, 'delete'])->name('presentation.delete');
        Route::get('/edit/{id}', [PresentasiController::class, 'edit'])->name('presentation.edit');
        Route::put('/update/{id}', [PresentasiController::class, 'update'])->name('presentation.update');
    });


    Route::group(['prefix' => 'fundsfinalization'], function () { //FinalisasiDanas
        Route::any('/', [FinalisasiDanaController::class, 'index'])->name('fundsfinalization.index')->middleware('auth');
        Route::get('/data', [FinalisasiDanaController::class, 'data'])->name('fundsfinalization.data');
        Route::post('/approve', [FinalisasiDanaController::class, 'approve'])->name('fundsfinalization.approve');
    });

    Route::group(['prefix' => 'loa'], function () { //Loa
        Route::any('/', [LoaController::class, 'index'])->name('loa.index')->middleware('auth');
        Route::get('/data', [LoaController::class, 'data'])->name('loa.data');
        Route::delete('/delete', [LoaController::class, 'delete'])->name('loa.delete');
        Route::get('/edit/{id}', [LoaController::class, 'edit'])->name('loa.edit');
        Route::get('/print_contract/{id}', [LoaController::class, 'print_contract'])->name('print_contract');
    });

    Route::group(['prefix' => 'monev'], function () { //Monev
        Route::any('/', [MonevController::class, 'index'])->name('monev.index')->middleware('auth');
        Route::get('/data', [MonevController::class, 'data'])->name('monev.data');
        Route::delete('/delete', [MonevController::class, 'delete'])->name('monev.delete');
        Route::get('/edit/{id}', [MonevController::class, 'edit'])->name('monev.edit');
        Route::get('/print_monev/{id}', [MonevController::class, 'print_monev'])->name('print_monev');
        ROute::post('/approve', [MonevController::class, 'approve'])->name('monev.approve');
    });
});

Route::group(['prefix' => 'reviewer'], function () { //reviewers
    Route::any('/', [ReviewerController::class, 'index'])->name('reviewers.index')->middleware('auth');
    Route::get('/data', [ReviewerController::class, 'data'])->name('reviewers.data');
    Route::delete('/delete', [ReviewerController::class, 'delete'])->name('reviewers.delete');
    Route::get('/show/{id}', [ReviewerController::class, 'show'])->name('reviewers.show');
    Route::post('/approval_reviewer', [ReviewerController::class, 'approval_reviewer'])->name('reviewers.approval_reviewer');
    Route::post('/reject', [ReviewerController::class, 'reject'])->name('reviewers.reject');
    Route::get('/revision/{id}', [ReviewerController::class, 'revision'])->name('reviewers.revision');
    Route::put('/update/{id}', [ReviewerController::class, 'update'])->name('reviewers.update');
    Route::get('/last-revision/{id}', [ReviewerController::class, 'last_revision'])->name('reviewers.last-revision');
    Route::put('/update2/{id}', [ReviewerController::class, 'update2'])->name('reviewers.update2');
    Route::post('/presentation', [ReviewerController::class, 'presentation'])->name('reviewers.presentation');
    Route::post('/mark_as_presented', [ReviewerController::class, 'mark_as_presented'])->name('reviewers.mark_as_presented');
    Route::get('/print_pdf/{id}', [ReviewerController::class, 'print_pdf'])->name('print_pdf');
    Route::get('/print_loa/{id}', [ReviewerController::class, 'print_loa'])->name('print_loa');
});

Route::group(['prefix' => 'vicerector1'], function () { //vicerector1
    Route::get('/', [ViceRector1Controller::class, 'index'])->name('vicerector1.index')->middleware('auth');
    Route::get('/data', [ViceRector1Controller::class, 'data'])->name('vicerector1.data');
    Route::delete('/delete', [ViceRector1Controller::class, 'delete'])->name('vicerector1.delete');
    Route::get('/edit/{id}', [ViceRector1Controller::class, 'edit'])->name('vicerector1.edit');
    Route::post('/approve', [ViceRector1Controller::class, 'approve'])->name('vicerector1.approve');
    Route::post('/disapprove', [ViceRector1Controller::class, 'disapprove'])->name('vicerector1.disapprove');
    Route::any('/show/{id}', [ViceRector1Controller::class, 'show'])->name('vicerector1.show');
    Route::get('/print_contract/{id}', [ViceRector1Controller::class, 'print_contract'])->name('vicerector1.print_contract');
});

Route::group(['prefix' => 'vicerector2'], function () { //vicerector2
    Route::get('/', [ViceRector2Controller::class, 'index'])->name('vicerector2.index')->middleware('auth');
    Route::get('/data', [ViceRector2Controller::class, 'data'])->name('vicerector2.data');
    Route::delete('/delete', [ViceRector2Controller::class, 'delete'])->name('vicerector2.delete');
    Route::get('/edit/{id}', [ViceRector2Controller::class, 'edit'])->name('vicerector2.edit');
    Route::post('/approve', [ViceRector2Controller::class, 'approve'])->name('vicerector2.approve');
    Route::post('/disapprove', [ViceRector2Controller::class, 'disapprove'])->name('vicerector2.disapprove');
    Route::any('/show/{id}', [ViceRector2Controller::class, 'show'])->name('vicerector2.show');
    Route::get('/transfer_receipt/{id}', [ViceRector2Controller::class, 'transfer_receipt'])->name('vicerector2.transfer_receipt');
    Route::put('/transfer_receipt_update/{id}', [ViceRector2Controller::class, 'transfer_receipt_update'])->name('vicerector2.transfer_receipt_update');
    Route::get('/transfer_receipt2/{id}', [ViceRector2Controller::class, 'transfer_receipt2'])->name('vicerector2.transfer_receipt2');
    Route::put('/transfer_receipt2_update/{id}', [ViceRector2Controller::class, 'transfer_receipt2_update'])->name('vicerector2.transfer_receipt2_update');
});

Route::middleware('auth')->group(function () {
    Route::any('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::any('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/details/{id}', [ProfileController::class, 'details'])->name('profile.details');
});

require __DIR__ . '/auth.php';

Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);

    Route::group(['prefix' => 'manage_account'], function () {
        Route::group(['prefix' => 'users'], function () { //route to manage users
            Route::any('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/data', [UserController::class, 'data'])->name('users.data');
            Route::any('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::any('/reset_password/{id}', [UserController::class, 'reset_password'])->name('users.reset_password');
            Route::delete('/delete', [UserController::class, 'delete'])->name('users.delete');
        });
        Route::group(['prefix' => 'roles'], function () { //route to manage roles
            Route::any('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/data', [RoleController::class, 'data'])->name('roles.data');
            Route::any('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::delete('/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
        Route::group(['prefix' => 'permissions'], function () { //route to manage permissions
            Route::any('/', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('/data', [PermissionController::class, 'data'])->name('permissions.data');
        });
    });
    Route::group(['prefix' => 'manage_data'], function () {
        Route::group(['prefix' => 'studyprogram'], function () { //route to manage study program
            Route::any('/', [StudyProgramController::class, 'index'])->name('program.index');
            Route::get('/data', [StudyProgramController::class, 'data'])->name('program.data');
            Route::delete('/delete', [StudyProgramController::class, 'delete'])->name('program.delete');
            Route::get('/edit/{id}', [StudyProgramController::class, 'edit'])->name('program.edit');
            Route::put('/update/{id}', [StudyProgramController::class, 'update'])->name('program.update');
        });
        Route::group(['prefix' => 'department'], function () { //route to manage study program
            Route::any('/', [DepartmentController::class, 'index'])->name('dept.index')->middleware('auth');
            Route::get('/data', [DepartmentController::class, 'data'])->name('dept.data');
            Route::delete('/delete', [DepartmentController::class, 'delete'])->name('dept.delete');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('dept.edit');
            Route::put('/update/{id}', [DepartmentController::class, 'update'])->name('dept.update');
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/cms', [CmsController::class, 'index'])->name('cms.index');
    Route::get('/cms/create', [CmsController::class, 'create'])->name('cms.create');
    Route::get('/posts/create/checkSlug', [CmsController::class, 'checkSlug'])->name('checkSlug');
    Route::post('/cms/store', [CmsController::class, 'store'])->name('cms.store');
    Route::delete('/delete/{id}', [CmsController::class, 'destroy'])->name('cms.destroy');
    Route::get('/edit/{id}', [CmsController::class, 'edit'])->name('cms.edit');
    Route::put('/update/{id}', [CmsController::class, 'update'])->name('cms.update');
});
