<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/tentang-kami', 'TentangController@index');

Route::get('/layanan', 'LayananController@index');

Route::get('/layanan/detail-layanan/{slug}', 'LayananController@detail');

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
});

// public portfolio
Route::get('/portofolio', 'PortfolioController@index');
Route::get('/portofolio/detail-portfolio/{slug}', 'PortfolioController@detail');

// public klien
Route::get('/klien', 'KlienController@index');
Route::get('/klien/detail-klien/{slug}', 'KlienController@detail');

// public karir
Route::get('/karir', 'KarirController@index');
Route::get('/karir/detail-karir/{slug}', 'KarirController@detail');
Route::post('/karir/detail-karir/store', 'KarirController@store');

// public estimasi
Route::get('/estimasi-project', 'EstimasiController@index');
Route::post('/estimasi-project/store', 'EstimasiController@store');

Route::group(['prefix' => 'admin'], function () {

    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        // section beranda
        Route::get('/', 'Admin\HomeController@index')->name('dashboard');
        Route::get('/dashboard/jsonportfolio', 'Admin\HomeController@jsonPortfolio');
        Route::get('/dashboard/jsonklien', 'Admin\HomeController@jsonKlien');

        Route::get('/admin/edit/{id}', 'Admin\AdminController@edit');
        Route::put('/admin/update/{id}', 'Admin\AdminController@update');

        Route::middleware('role:superadmin')->group(function () {
            //section admin
            Route::get('/admin', 'Admin\AdminController@index');
            Route::get('/admin/json', 'Admin\AdminController@json');
            Route::get('/admin', 'Admin\AdminController@index');

            Route::get('/admin/create', 'Admin\AdminController@create');
            Route::post('/admin/store', 'Admin\AdminController@store');
            Route::post('/admin/delete/{id}', 'Admin\AdminController@destroy');
        });
        Route::middleware('role:superadmin,admin')->group(function () {
            // section team
            Route::get('/team', 'Admin\TeamController@index');
            Route::get('/team/json', 'Admin\TeamController@json');

            Route::get('/team/insert-team', 'Admin\TeamController@showInsert');
            Route::post('/team/insert-team/store', 'Admin\TeamController@store');

            Route::get('/team/update-team/{slug}', 'Admin\TeamController@showUpdate');
            Route::post('/team/update-team/update/{slug}', 'Admin\TeamController@update');
            Route::post('/team/delete-team/destroy/{slug}', 'Admin\TeamController@destroy');

            // section clients
            Route::get('/client', 'Admin\ClientController@index');
            Route::get('/client/json', 'Admin\ClientController@json');

            Route::get('/client/insert-client', 'Admin\ClientController@showInsert');
            Route::post('/client/insert-client/store', 'Admin\ClientController@store');

            Route::get('/client/update-client/{slug}', 'Admin\ClientController@showUpdate');
            Route::post('/client/update-client/update/{slug}', 'Admin\ClientController@update');
            Route::post('/client/delete-client/destroy/{id}', 'Admin\ClientController@destroy');

            // section portoflio
            Route::get('/portfolio', 'Admin\PortfolioController@index');
            Route::get('/portfolio/json', 'Admin\PortfolioController@json');
            Route::get('/portfolio/insert-portfolio', 'Admin\PortfolioController@showInsert');
            Route::post('/portfolio/insert-portfolio/store', 'Admin\PortfolioController@store');

            Route::get('/portfolio/update-portfolio/{slug}', 'Admin\PortfolioController@showUpdate');
            Route::post('/portfolio/update-portfolio/update/{slug}', 'Admin\PortfolioController@update');
            Route::post('/portfolio/delete-portfolio/destroy/{id}', 'Admin\PortfolioController@destroy');
            Route::delete('/portofolio/delete-gambar/{id}/{index}', 'Admin\PortfolioController@delete_gambar');



            // section tipe
            Route::get('/tipe', 'Admin\TipeController@index');

            Route::get('/tipe/jsonkarir', 'Admin\TipeController@jsonKarir');
            Route::get('/tipe/insert-tipekarir', 'Admin\TipeController@showInsertKarir');
            Route::post('/tipe/insert-tipekarir/store', 'Admin\TipeController@storeKarir');
            Route::get('/tipe/update-tipe-karir/{slug}', 'Admin\TipeController@showUpdateKarir');
            Route::post('/tipe/update-tipe-karir/update/{slug}', 'Admin\TipeController@updateKarir');
            Route::post('/tipe/delete-tipe-karir/destroy/{id}', 'Admin\TipeController@destroyKarir');

            Route::get('/tipe/jsonlingkup', 'Admin\TipeController@jsonLingkup');
            Route::get('/tipe/insert-tipelingkup', 'Admin\TipeController@showInsertLingkup');
            Route::post('/tipe/insert-tipelingkup/store', 'Admin\TipeController@storeLingkup');
            Route::get('/tipe/update-tipe-lingkup/{slug}', 'Admin\TipeController@showUpdateLingkup');
            Route::post('/tipe/update-tipe-lingkup/update/{slug}', 'Admin\TipeController@updateLingkup');
            Route::post('/tipe/delete-tipe-lingkup/destroy/{id}', 'Admin\TipeController@destroyLingkup');

            //tipe karir
            Route::get('/tipe-karir', 'Admin\TipeKarirController@index');
            Route::get('/tipe-karir/jsonproject', 'Admin\TipeKarirController@jsonKarir');
            Route::get('/tipe-karir/create', 'Admin\TipeKarirController@create');
            Route::get('/tipe-karir/edit/{slug}', 'Admin\TipeKarirController@edit');
            Route::post('/tipe-karir/store', 'Admin\TipeKarirController@store');
            Route::post('/tipe-karir/update/{slug}', 'Admin\TipeKarirController@update');
            Route::post('/tipe-karir/destroy/{id}', 'Admin\TipeKarirController@destroy');

            //tipe project
            Route::get('/tipe-project', 'Admin\TipeProjectController@index');
            Route::get('/tipe-project/jsonproject', 'Admin\TipeProjectController@jsonProject');
            Route::get('/tipe-project/create', 'Admin\TipeProjectController@create');
            Route::get('/tipe-project/edit/{slug}', 'Admin\TipeProjectController@edit');
            Route::post('/tipe-project/store', 'Admin\TipeProjectController@store');
            Route::post('/tipe-project/update/{slug}', 'Admin\TipeProjectController@update');
            Route::post('/tipe-project/destroy/{id}', 'Admin\TipeProjectController@destroy');

            //section about
            Route::get('/about', 'Admin\AboutController@index');
            Route::post('/about/update/{request}', 'Admin\AboutController@update');

            //section contact
            Route::get('/contact', 'Admin\ContactController@index');
            Route::post('/contact/update/{request}', 'Admin\ContactController@update');

            Route::post('/dashboard/client/update/{id}', 'Admin\HomeController@updateClient');
            Route::post('/dashboard/portfolio/update/{id}', 'Admin\HomeController@updatePortfolio');

            // section SomeBot - Projects
            Route::get('/somebot-projects', 'Admin\SomebotProjectsController@index');
            Route::get('/somebot-projects/json', 'Admin\SomebotProjectsController@json');

            Route::post('/somebot-projects/insert-project/store', 'Admin\SomebotProjectsController@store');

            Route::post('/somebot-projects/delete-project/destroy/{id}', 'Admin\SomebotProjectsController@destroy');

            Route::get('/somebot-projects/update-project/{id}', 'Admin\SomebotProjectsController@showUpdate');
            Route::post('/somebot-projects/update-project/update/{id}', 'Admin\SomebotProjectsController@update');

            //Section SomeBot - Groups
            Route::get('/somebot-groups', 'Admin\SomebotGroupsController@index');
            Route::get('/somebot-groups/json', 'Admin\SomebotGroupsController@json');
            Route::get('/somebot-groups/showdetail/{id}', 'Admin\SomebotGroupsController@showDetail');

            Route::post('/somebot-groups/delete-group/destroy/{group_id}', 'Admin\SomebotGroupsController@destroy');

            Route::get('/somebot-groups/update-group/{group_id}', 'Admin\SomebotGroupsController@showUpdate');
            Route::get('/somebot-groups/update-group/{group_id}/getprojects', 'Admin\SomebotGroupsController@getProjects');
            Route::post('/somebot-groups/update-group/update/{group_id}', 'Admin\SomebotGroupsController@update');
        });

        Route::middleware('role:sdm,admin,superadmin')->group(function () {
            // section estimasi
            Route::get('/estimasi', 'Admin\EstimasiController@index');
            Route::get('/estimasi/json', 'Admin\EstimasiController@json');
            Route::post('/estimasi/get', 'Admin\EstimasiController@getAllEstimasi')->name('estimasi.get');

            Route::post('/estimasi/delete-estimasi/destroy/{id}', 'Admin\EstimasiController@destroy');

            // section karir
            Route::get('/karir', 'Admin\KarirController@index');
            Route::get('/karir/jsonCarrer', 'Admin\KarirController@jsonCarrer');
            Route::get('/karir/insert-karir', 'Admin\KarirController@showInsert');
            Route::post('/karir/insert-karir/store', 'Admin\KarirController@store');

            Route::get('/karir/update-karir/{slug}', 'Admin\KarirController@showUpdate');
            Route::post('/karir/update-karir/update/{slug}', 'Admin\KarirController@update');

            Route::post('/karir/delete-karir/destroy/{id}', 'Admin\KarirController@destroyKarir');
            Route::post('/karir/delete-pelamar/destroy/{id}', 'Admin\KarirController@destroyApplicant');
        });

        Route::middleware('role:sdm,superadmin')->group(function () {

            // section pelamar
            Route::get('/applicant/jsonApplicants', 'Admin\ApplicantController@jsonApplicant');
            Route::get('/applicant', 'Admin\ApplicantController@index');

            Route::get('/applicant/download/{id}', 'Admin\ApplicantController@download')->name('applicant.download');

            //pegawai
            Route::get('/employee/json', 'Admin\EmployeeController@json');
            Route::resource('/employee', 'Admin\EmployeeController');
            Route::get('/employee/updateStatus/{id}', 'Admin\EmployeeController@updateStatus')->name('employee.updateStatus');

            //Jabatan
            Route::get('/position/json', 'Admin\PositionController@json');
            Route::resource('position', 'Admin\PositionController');

            //Gaji
            Route::get('/salary/json', 'Admin\SalaryController@json');
            Route::resource('salary', 'Admin\SalaryController');
            Route::get('/salary/show-detail-salary/{id}', 'Admin\SalaryController@show_detail');
            Route::put('/salary/detail-update/{id}', 'Admin\SalaryController@detail_update');
            Route::get('/salary/delete-detail/{id}', 'Admin\SalaryController@delete_detail');

            Route::get('/salary/detail-gaji/{id}', 'Admin\SalaryController@detail_gaji');
            Route::put('/salary/detail-gaji/{id}', 'Admin\SalaryController@detail_gaji_store')->name('salary_detail.update');

            Route::get('/salary/send-email/{id}', 'Admin\SalaryMailController@sendMail');
            Route::get('/salary/print-csv/{id}', 'Admin\SalaryController@printCSV');

            // Pelatihan karyawan
            Route::get('/training', 'Admin\TrainingController@index')->name('training');
            Route::get('/training/json', 'Admin\TrainingController@json');

            // new single input blade
            Route::get('/training/input-training', 'Admin\TrainingController@showInsert')->name('training.show.insert');
            Route::post('/training/input-training/store', 'Admin\TrainingController@store')->name('training.insert.store');

            Route::get('/training/input-training/{id}', 'Admin\TrainingController@showUpdate')->name('training.show.update');
            Route::post('/training/input-training/update/{id}', 'Admin\TrainingController@update')->name('training.update');

            Route::post('/training/delete-training/destroy/{id}', 'Admin\TrainingController@destroy')->name('training.destroy');
        });


        //send email per orang
        Route::get('/salary/send-email-satuan/{id}', 'Admin\SalaryMailController@sendMailSatuan');

        Route::get('/ujicoba', function () {
            $data['salary_detail'] = \App\SalaryDetail::with('salary', 'employee', 'employee.position')->where('salary_id', 32)->first();
            return view('admin.pages.salary.email', $data);
        });
        Route::get('/ujicobaa', function () {
            $data['salary_detail'] = \App\SalaryDetail::with('salary', 'employee', 'employee.position')->where('salary_id', 32)->first();
            return view('admin.pages.salary.email-new', $data);
        });
    });
});