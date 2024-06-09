<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\LectureType;
use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $categories = Category::count();
        $courses = Course::count();
        $users = User::where('id', '!=', 1)->count();
        $newArrivalCourses = Course::orderBy('id', 'desc')->paginate(5);
        $lecture_types = LectureType::count();
        return view('admins.dashboard', compact('categories', 'courses', 'users', 'newArrivalCourses','lecture_types'));
    }

    public function lecture_type()
    {
        return view('admins.lecture_type');
    }
}
