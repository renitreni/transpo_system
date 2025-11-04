<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportFileController;
use App\Http\Controllers\HomeController;
use App\Livewire\Admin\Admins\Users;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\Delivery\CreateDelivery;
use App\Livewire\Admin\Delivery\EditDelivery;
use App\Livewire\Admin\Delivery\ManageDeliveries;
use App\Livewire\Admin\FileLogLivewire;
use App\Livewire\Admin\Inquire\ManageInquiries;
use App\Livewire\Admin\Renting\Renting;
use App\Livewire\Admin\Stock\GeneralSearchResult;
use App\Livewire\Admin\Stock\ManageStocks;
use App\Livewire\Admin\Supplier\ApprovalForm;
use App\Livewire\Admin\Supplier\Edit;
use App\Livewire\Admin\Supplier\Supplier;
use App\Livewire\Admin\Supplier\View;
use App\Livewire\Admin\Workshop\CreateWarranty;
use App\Livewire\Admin\Workshop\EditWarranty;
use App\Livewire\Admin\Workshop\MaintenanceLivewire;
use App\Livewire\Admin\Workshop\ManageWarranty;
use App\Livewire\Admin\Workshop\ManageWorkshop;
use App\Livewire\Admin\Workshop\Workshop;
use App\Livewire\Maintenance\Error;
use Illuminate\Support\Facades\Route;

//* Guest Routes
Route::get('/', function () {
    return redirect()->route('home_page', ['lang' => 'en']);
});
Route::get('/home/{lang}', HomeController::class)->name('home_page');
Route::get('/home/{lang}/inquire', HomeController::class)->name('inquire_page');
Route::get('/home/{lang}/contact', HomeController::class)->name('contact_page');

Route::get('/admin', fn () => redirect()->route('login'));

//* Administrator Routes
Route::prefix('admin')->group(function () {
    Route::get('login', Login::class)->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::get('{lang}/file-log', FileLogLivewire::class);

        Route::get('{lang}@dashboard', Dashboard::class)->name('admin_Dashboard');
        Route::get('{lang}@workshop/{page?}', Workshop::class)->name('admin_Workshop');

        Route::prefix('{lang}@supplier')->group(function () {
            Route::get('/', Supplier::class)->name('admin_Supplier');
            Route::get('/view/{id}', View::class)->name('admin_View_Supplier');
        });

        Route::prefix('{lang}/inquiry')->group(function () {
            Route::get('@manage-inquiries', ManageInquiries::class)->name('admin_ManageInquiries');
        });

        Route::get('{lang}@inventory', Error::class)->name('admin_ManageInventories');

        Route::get('{lang}@stocks={type}', ManageStocks::class)->name('admin_ManageStocks');
        Route::get('{lang}@stocks/chassis={chassisNumber}', GeneralSearchResult::class)->name('admin_generalSearch');

        Route::prefix('{lang}/delivery')->group(function () {
            Route::get('@create', CreateDelivery::class)->name('admin_CreateReceipt');
            Route::get('@edit-receipt={customer_uuid}', EditDelivery::class)->name('admin_EditReceipt');
            Route::get('@manage', ManageDeliveries::class)->name('admin_ManageDeliveries');
        });

        Route::get('{lang}/workshop/@manage', ManageWorkshop::class)->name('admin_ManageWorkshop');

        Route::prefix('{lang}/warranty')->group(function () {
            Route::get('@manage', ManageWarranty::class)->name('admin_ManageWarranty');
            Route::get('@create', CreateWarranty::class)->name('admin_CreateWarranty');
            Route::get('@create/approval={id}', ApprovalForm::class)->name('admin_Approval');
            Route::get('@edit={warranty_id}', EditWarranty::class)->name('admin_EditWarranty');
            Route::get('@edit/details/{id}', Edit::class)->name('admin_EditSupplier');
        });

        Route::prefix('{lang}/renting')->group(function () {
            Route::get('/{page?}/{id?}', Renting::class)->name('admin_Renting');
        });
        Route::get('/open-file/{file}', fn (string $file) => response()->file(Illuminate\Support\Facades\Storage::path("public/uploads/renting/{$file}")))->name('show-file');

        Route::get('{lang}/users', Users::class)->name('admin_Users');

        Route::get('logout', [AdminController::class, 'logout'])->name('admin_Logout');

        // new approach
        Route::get('export/xlsx', [ExportFileController::class, 'downloadXLSX'])->name('export-xlsx');
        Route::get('{lang}/maintenance', MaintenanceLivewire::class)->name('maintenance');
    });
});
