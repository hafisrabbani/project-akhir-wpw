<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\AdminController;
use App\Filters\Roles;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
All Role Routing Here!
*/
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->addMiddleware(Roles::class);
/* End All Role Here! */


/* Mahasiswa Routing Here! */
/* End Mahasiswa Routing Here! */


/* Dosen Routing Here! */
/* End Dosen Routing Here! */

/*Admin Routing Here!*/
Route::get('dashboard/manage-user', [AdminController::class, 'manageUser'])->name('manage-user')->addMiddleware(Roles::class);
Route::post('dashboard/manage-user', [AdminController::class, 'manageUserPost'])->name('manage-user.post')->addMiddleware(Roles::class);
Route::get('dashboard/manage-user/delete/{id}', [AdminController::class, 'manageUserDelete'])->name('manage-user.delete')->addMiddleware(Roles::class);
Route::get('dashboard/manage-user/edit/{id}', [AdminController::class, 'manageUserEdit'])->name('manage-user.edit')->addMiddleware(Roles::class);
Route::post('dashboard/manage-user/edit/{id}', [AdminController::class, 'manageUserEditPost'])->name('manage-user.edit.post')->addMiddleware(Roles::class);
