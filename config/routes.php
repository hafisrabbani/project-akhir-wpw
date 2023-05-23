<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\DosenController;
use App\Controllers\AdminController;
use App\Controllers\MahasiswaController;
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
Route::get('dashboard/mhs/list-course', [MahasiswaController::class, 'listCourse'])->name('mhs.list-course')->addMiddleware(Roles::class);
Route::get('dashboard/mhs/list-course/lesson/{id}', [MahasiswaController::class, 'listLesson'])->name('mhs.list-lesson')->addMiddleware(Roles::class);
/* End Mahasiswa Routing Here! */


/* Dosen Routing Here! */
Route::get('dashboard/list-course', [DosenController::class, 'listCourse'])->name('list-course')->addMiddleware(Roles::class);
Route::get('dashboard/list-course/{id}', [DosenController::class, 'listCourseDetail'])->name('list-course.detail')->addMiddleware(Roles::class);
// Lesson Routes
Route::get('dashboard/list-course/{id}/lesson', [DosenController::class, 'listCourseLesson'])->name('list-course.lesson')->addMiddleware(Roles::class);
Route::post('dashboard/list-course/{id}/lesson', [DosenController::class, 'lessonCreate'])->name('list-course.lesson.post')->addMiddleware(Roles::class);
Route::get('dashboard/list-course/lesson/{lesson_id}', [DosenController::class, 'listCourseLessonDetail'])->name('list-course.lesson.detail')->addMiddleware(Roles::class);
Route::post('dashboard/list-course/lesson/{lesson_id}', [DosenController::class, 'listCourseLessonUpdate'])->name('list-course.lesson.detail.update')->addMiddleware(Roles::class);
Route::get('dashboard/lesson/delete/{id}', [DosenController::class, 'lessonDelete'])->name('lesson.delete')->addMiddleware(Roles::class);
Route::get('/dasboard/lesson/list-mahasiswa/{id}', [DosenController::class, 'listMhs'])->name('course.mhs')->addMiddleware(Roles::class);
// Assignment Routes
Route::get('dashboard/list-course/assignment/{id}', [DosenController::class, 'assignmentList'])->name('assignment.list')->addMiddleware(Roles::class);
Route::post('dashboard/list-course/{id}/assignment/create', [DosenController::class, 'assignmentPost'])->name('assignment.create')->addMiddleware(Roles::class);
Route::get('dashboard/list-course/assignment/{id}/detail', [DosenController::class, 'assignmentDetail'])->name('assignment.detail')->addMiddleware(Roles::class);
Route::post('dashbord/list-course/assignment/{id}/update', [DosenController::class, 'assignmentUpdate'])->name('assignment.update')->addMiddleware(Roles::class);
Route::get('dashborad/list-course/assginment/{id}/delete', [DosenController::class, 'assignmentDelete'])->name('assignment.delete')->addMiddleware(Roles::class);
/* End Dosen Routing Here! */

/*Admin Routing Here!*/
Route::get('dashboard/manage-user', [AdminController::class, 'manageUser'])->name('manage-user')->addMiddleware(Roles::class);
Route::post('dashboard/manage-user', [AdminController::class, 'manageUserPost'])->name('manage-user.post')->addMiddleware(Roles::class);
Route::post('dashboard/manage-user/delete/{id}', [AdminController::class, 'manageUserDelete'])->name('manage-user.delete')->addMiddleware(Roles::class);
Route::get('dashboard/manage-user/edit/{id}', [AdminController::class, 'manageUserEdit'])->name('manage-user.edit')->addMiddleware(Roles::class);
Route::post('dashboard/manage-user/edit/{id}', [AdminController::class, 'manageUserEditPost'])->name('manage-user.edit.post')->addMiddleware(Roles::class);

Route::get('dashboard/enrollment', [AdminController::class, 'enrollment'])->name('enrollment')->addMiddleware(Roles::class);
Route::post('dashboard/enrollment', [AdminController::class, 'enrollmentPost'])->name('enrollment.post')->addMiddleware(Roles::class);
Route::get('dashboard/enrollment/delete/{id}', [AdminController::class, 'enrollmentDelete'])->name('enrollment.delete')->addMiddleware(Roles::class);
Route::get('dashboard/enrollment/edit/{id}', [AdminController::class, 'enrollmentEdit'])->name('enrollment.edit')->addMiddleware(Roles::class);
Route::post('dashboard/enrollment/edit/{id}', [AdminController::class, 'enrollmentEditPost'])->name('enrollment.edit.post')->addMiddleware(Roles::class);

Route::get('dashboard/courses', [AdminController::class, 'courses'])->name('courses')->addMiddleware(Roles::class);
Route::post('dashboard/courses', [AdminController::class, 'coursesPost'])->name('courses.post')->addMiddleware(Roles::class);
Route::get('dashboard/courses/delete/{id}', [AdminController::class, 'coursesDelete'])->name('courses.delete')->addMiddleware(Roles::class);
Route::get('dashboard/courses/edit/{id}', [AdminController::class, 'coursesEdit'])->name('courses.edit')->addMiddleware(Roles::class);
Route::post('dashboard/courses/edit/{id}', [AdminController::class, 'coursesEditPost'])->name('courses.edit.post')->addMiddleware(Roles::class);
