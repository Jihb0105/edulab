<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveChatController;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [UserController::class, 'showWelcome'])->name('welcome');

Auth::routes();

//Register Lecturer
Route::get('/lecturer/register', [LecturerController::class, 'registerLecturerView'])->name('lecturer.register');

Route::post('/lecturer/register', [LecturerController::class, 'registerLecturer'])->name('lecturer.register.store');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/terms', [UserController::class, 'terms'])->name('users.terms');

Route::get('/privacy', [UserController::class, 'privacy'])->name('users.privacy');

Route::get('/category/{category}', [UserController::class, 'getSingleCategory'])->name('users.category');

Route::get('/course/{course}', [UserController::class, 'showCourse'])->name('users.course');

Route::get('/course/chapter/{chapter}', [UserController::class, 'showChapter'])->name('users.chapter');

Route::get('/course/chapter/{chapter}/download', [UserController::class, 'downloadFile'])->name('users.downloadFile');

Route::get('/course/chapter/{chapter}/resource', [UserController::class, 'showResource'])->name('users.resource');

Route::get('/course/chapter/{chapter}/question', [UserController::class, 'showQuiz'])->name('users.quiz');

Route::post('/course/chapter/{chapter}/question/submit', [UserController::class, 'submitAns'])->name('users.submit');

Route::get('/search', function(Request $request) {
    if($request->search){
        $searchCourses = Course::where('title', "LIKE", '%'.$request->search.'%')->paginate(10);
        return view('users.search', compact('searchCourses'));
    }
});

Route::get('/quiz/end', function(){
    return view('users.quizzes.endQuiz');
});

Route::get('/course/chapter/{chapter}/discussion', [UserController::class, 'showDiscussion'])->name('users.discussion'); // Post

Route::post('/course/chapter/{chapter}/comment/store', [UserController::class, 'storeComment'])->name('users.store.comment');

Route::post('/course/chapter/{chapter}/comment/reply', [UserController::class, 'storeReply'])->name('users.store.reply');

Route::middleware(['auth', 'user-access:student'])->group(function () {
    // Rating
    Route::post('/user/course/add-rating', [UserController::class, 'addRating'])->name('users.add.rating');

    // Profile
    Route::get('/user/settings/profile', [ProfileController::class, 'uEdit'])->name('users.settings.profile.edit');

    Route::put('/user/settings/profile', [ProfileController::class, 'uUpdate'])->name('users.settings.profile.update');

    Route::delete('/user/settings/profile', [ProfileController::class, 'destroy'])->name('users.settings.profile.destroy');

    Route::get('/user/settings/courses', [ProfileController::class, 'getEnrollment'])->name('users.getEnrolled');

    Route::post('/user/enroll', [UserController::class, 'enrollment'])->name('users.enrollment');

    Route::get('/user/settings/watchlist', [ProfileController::class, 'getWatchlist'])->name('users.getWatchlist');

    Route::post('/user/watchlist', [UserController::class, 'watchlist'])->name('users.watchlist');

});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'adminDashboard'])->name('admins.dashboard');

    //Users Management
    Route::get('/admin/user', [ApprovalController::class, 'index'])->name('admins.users.index');
    
    Route::get('/admin/user/{user}/edit', [ApprovalController::class, 'edit'])->name('admins.users.edit');

    Route::get('/admin/user/download', [ApprovalController::class, 'downloadCV'])->name('admins.users.downloadCv');

    Route::get('/admin/user/{user}/approve', [ApprovalController::class, 'approve'])->name('admins.users.approve');

    Route::get('/admin/user/{user}/reject', [ApprovalController::class, 'reject'])->name('admins.users.reject');

    //Category
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admins.categories.index');

    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admins.categories.create');

    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admins.categories.store');

    Route::get('/admin/category/{category}', [CategoryController::class, 'show'])->name('admins.categories.show');

    Route::get('/admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('admins.categories.edit');

    Route::put('/admin/category/{category}', [CategoryController::class, 'update'])->name('admins.categories.update');

    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('admins.categories.destroy');
    
    //Course
    Route::get('/admin/course', [CourseController::class, 'index'])->name('admins.courses.index');

    Route::get('/admin/course/{course}/edit', [CourseController::class, 'edit'])->name('admins.courses.edit');

    Route::put('/admin/course/{course}', [CourseController::class, 'update'])->name('admins.courses.update');

    Route::delete('/admin/course/{course}', [CourseController::class, 'destroy'])->name('admins.courses.destroy');

    // Chapters
    Route::get('/admin/chapter/{chapter}/edit', [ChapterController::class, 'edit'])->name('admins.chapters.edit');

    Route::put('/admin/chapter/{chapter}', [ChapterController::class, 'update'])->name('admins.chapters.update');

    Route::delete('/admin/chapter/{chapter}', [ChapterController::class, 'destroy'])->name('admins.chapters.destroy');

    Route::get('/admin/chapter/back', [ChapterController::class, 'backButton'])->name('admins.chapters.backButton');

    // Resources
    Route::get('/admin/chapter/{chapter}/resource', [ResourceController::class, 'index'])->name('admins.resource.index');

    Route::get('/admin/{chapter}/resource/create', [ResourceController::class, 'create'])->name('admins.resource.create');

    Route::post('/admin/resource', [ResourceController::class, 'store'])->name('admins.resource.store');

    Route::get('/admin/resource/{resource}/edit', [ResourceController::class, 'edit'])->name('admins.resource.edit');

    Route::put('/admin/resource/{resource}', [ResourceController::class, 'update'])->name('admins.resource.update');

    Route::delete('/admin/resource/{resource}', [ResourceController::class, 'destroy'])->name('admins.resource.destroy');

    Route::get('/admin/resource/back', [ResourceController::class, 'backButton'])->name('admins.resource.backButton');

    // Questions
    Route::get('/admin/chapter/{chapter}/questions', [QuizController::class, 'index'])->name('admins.quiz.index');

    Route::get('/admin/question/{question}/edit', [QuizController::class, 'edit'])->name('admins.quiz.edit');
    
    Route::put('/admin/question/{question}', [QuizController::class, 'update'])->name('admins.quiz.update');

    Route::delete('/admin/question/{question}', [QuizController::class, 'destroy'])->name('admins.quiz.destroy');

    Route::get('/admin/question/back', [ResourceController::class, 'backButton'])->name('admins.quiz.backButton');

    //Live Chat
    Route::get('/admin/live_chat', [LiveChatController::class, 'index'])->name('admins.live_chat.index');

    Route::post('/admin/live_chat/store', [LiveChatController::class, 'store'])->name('admins.live_chat.store');

    Route::delete('/admin/live_chat/delete', [LiveChatController::class, 'destroy'])->name('admins.live_chat.destroy');

});

Route::middleware(['auth', 'user-access:lecturer'])->group(function () {

    // Dashboard
    Route::get('/lecturer', [LecturerController::class, 'lecturerDashboard'])->name('lecturers.dashboard');

    // Profile
    Route::get('/lecturer/settings/profile', [ProfileController::class, 'lEdit'])->name('lecturers.settings.profile.edit');

    Route::put('/lecturer/settings/profile', [ProfileController::class, 'lUpdate'])->name('lecturers.settings.profile.update');

    Route::delete('/lecturer/settings/profile', [ProfileController::class, 'destroy'])->name('lecturers.settings.profile.destroy');

    // Job Titles
    Route::get('/lecturer/settings/profile/job_title/{user}/create', [ProfileController::class, 'createJobTitle'])->name('lecturers.settings.profile.jobTitle.create');

    Route::post('/lecturer/settings/profile/job_title', [ProfileController::class, 'storeJobTitle'])->name('lecturers.settings.profile.jobTitle.store');

    Route::get('/lecturer/settings/profile/job_title/{job_title}/edit', [ProfileController::class, 'editJobTitle'])->name('lecturers.settings.profile.jobTitle.edit');

    Route::put('/lecturer/settings/profile/job_title/{job_title}', [ProfileController::class, 'updateJobTitle'])->name('lecturers.settings.profile.jobTitle.update');

    Route::delete('/lecturer/settings/profile/job_title/{job_title}', [ProfileController::class, 'destroyJobTitle'])->name('lecturers.settings.profile.jobTitle.destroy');

    // Courses
    Route::get('/lecturer/course', [CourseController::class, 'index'])->name('lecturers.courses.index');

    Route::get('/lecturer/course/create', [CourseController::class, 'create'])->name('lecturers.courses.create');

    Route::post('/lecturer/course', [CourseController::class, 'store'])->name('lecturers.courses.store');

    Route::get('/lecturer/course/{course}/edit', [CourseController::class, 'edit'])->name('lecturers.courses.edit');

    Route::put('/lecturer/course/{course}', [CourseController::class, 'update'])->name('lecturers.courses.update');

    Route::delete('/lecturer/course/{course}', [CourseController::class, 'destroy'])->name('lecturers.courses.destroy');

    // Chapters
    Route::get('/lecturer/course/{course}/chapter/create', [ChapterController::class, 'create'])->name('lecturers.chapters.create');

    Route::post('/lecturer/chapter', [ChapterController::class, 'store'])->name('lecturers.chapters.store');

    Route::get('/lecturer/chapter/{chapter}/edit', [ChapterController::class, 'edit'])->name('lecturers.chapters.edit');

    Route::put('/lecturer/chapter/{chapter}', [ChapterController::class, 'update'])->name('lecturers.chapters.update');

    Route::delete('/lecturer/chapter/{chapter}', [ChapterController::class, 'destroy'])->name('lecturers.chapters.destroy');

    Route::get('/lecturer/chapter/back', [ChapterController::class, 'backButton'])->name('lecturers.chapters.backButton');

    // Resources
    Route::get('/lecturer/chapter/{chapter}/resource', [ResourceController::class, 'index'])->name('lecturers.resource.index');

    Route::get('/lecturer/chapter/{chapter}/resource/create', [ResourceController::class, 'create'])->name('lecturers.resource.create');

    Route::post('/lecturer/resource', [ResourceController::class, 'store'])->name('lecturers.resource.store');

    Route::get('/lecturer/resource/{resource}/edit', [ResourceController::class, 'edit'])->name('lecturers.resource.edit');

    Route::put('/lecturer/resource/{resource}', [ResourceController::class, 'update'])->name('lecturers.resource.update');

    Route::delete('/lecturer/resource/{resource}', [ResourceController::class, 'destroy'])->name('lecturers.resource.destroy');

    Route::get('/lecturer/resource/back', [ResourceController::class, 'backButton'])->name('lecturers.resource.backButton');

    // Questions
    Route::get('/lecturer/chapter/{chapter}/questions', [QuizController::class, 'index'])->name('lecturers.quiz.index');

    Route::post('/lecturer/question', [QuizController::class, 'store'])->name('lecturers.quiz.store');

    Route::get('/lecturer/question/{question}/edit', [QuizController::class, 'edit'])->name('lecturers.quiz.edit');
    
    Route::put('/lecturer/question/{question}', [QuizController::class, 'update'])->name('lecturers.quiz.update');

    Route::delete('/lecturer/question/{question}', [QuizController::class, 'destroy'])->name('lecturers.quiz.destroy');

    Route::get('/lecturer/question/back', [ResourceController::class, 'backButton'])->name('lecturers.quiz.backButton');

    //Live Chat
    Route::get('/lecturer/live_chat', [LiveChatController::class, 'index'])->name('lecturers.live_chat.index');

    Route::post('/lecturer/live_chat/store', [LiveChatController::class, 'store'])->name('lecturers.live_chat.store');

    Route::delete('/lecturer/live_chat/delete', [LiveChatController::class, 'destroy'])->name('lecturers.live_chat.destroy');
});