<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('register_branch', function () {
    return view('register_branch');
})->name('register_branch');

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Items
    Route::delete('items/destroy', 'ItemsController@massDestroy')->name('items.massDestroy');
    Route::post('items/media', 'ItemsController@storeMedia')->name('items.storeMedia');
    Route::post('items/ckmedia', 'ItemsController@storeCKEditorImages')->name('items.storeCKEditorImages');
    Route::resource('items', 'ItemsController');

    // Workers
    Route::delete('workers/destroy', 'WorkerController@massDestroy')->name('workers.massDestroy');
    Route::resource('workers', 'WorkerController');
});


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
