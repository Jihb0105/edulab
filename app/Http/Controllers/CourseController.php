<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $aCourses = Course::orderBy('id', 'asc')->where(function ($query){
            if ($search = request()->query('search')) {
                $query->where("title", "LIKE", "%{$search}%");
            }
        })->paginate(10);

        $lCourses = Course::orderBy('id', 'asc')->where('instructor_id', auth()->user()->id)
        ->where(function ($query){
            if ($search = request()->query('search')) {
                $query->where("title", "LIKE", "%{$search}%");
            }
        })->paginate(10);

        if(auth()->user()->type == 'admin'){
            return view('admins.courses.index', compact('aCourses'));
        }elseif(auth()->user()->type == 'lecturer'){
            return view('lecturers.courses.index', compact('lCourses'));
        }
    }

    public function create()
    {
        $categories = Category::orderBy('id')->pluck('title', 'id');
        return view('lecturers.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'instructor_id' => 'required',
            'course_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'hours' => 'required',
            'minutes'=> 'required',
            'course_overview' => 'required',
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->instructor_id = $request->instructor_id;
        $imageName = '';
        if ($request->hasFile('course_image')) {
            $imageName = time().$request->file('course_image')->getClientOriginalName();
            $request->file('course_image')->storeAs('course_images', $imageName, 'public');
        } else {
            $imageName = $course->course_image;
        }
        $course->course_image = $imageName;
        $course->category_id = $request->category_id;
        $course->hours = $request->hours;
        $course->minutes = $request->minutes;
        $course->course_overview = $request->course_overview;

        $course->save();

        return redirect()->route('lecturers.courses.index')->with('message', 'Course has been added successfully');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::orderBy('id')->pluck('title', 'id');
        $chapters = Chapter::orderBy('chapter_no', 'asc')->where('course_id', Course::findOrFail($id)->id)->paginate(5);

        Session::put('cEdit_url', request()->fullUrl());

        if(auth()->user()->type == 'admin'){
            return view('admins.courses.edit', compact('course', 'categories', 'chapters'));
        }elseif(auth()->user()->type == 'lecturer'){
            return view('lecturers.courses.edit', compact('course', 'categories', 'chapters'));
        }
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'instructor_id' => 'required',
            'course_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'hours' => 'required',
            'minutes'=> 'required',
            'course_overview' => 'required',
        ]);

        $imageName = '';
        if ($request->hasFile('course_image')) {
            $imageName = time().$request->file('course_image')->getClientOriginalName();
            $request->file('course_image')->storeAs('course_images', $imageName, 'public');
            if ($course->course_image) {
                Storage::delete('course_images/' . $course->course_image);
            }
        } else {
            $imageName = $course->course_image;
        }

        $courseData = ['title' => $request->title, 'instructor_id' => $request->instructor_id, 'category_id' => $request->category_id, 'course_image' => $imageName, 'hours' => $request->hours, 'minutes' => $request->minutes, 'course_overview' => $request->course_overview];

        $course->update($courseData);

        if(auth()->user()->type == 'admin'){
            return redirect()->route('admins.courses.index')->with('message', 'Course has been updated successfully');
        }elseif(auth()->user()->type == 'lecturer'){
            return redirect()->route('lecturers.courses.index')->with('message', 'Course has been updated successfully');
        }

    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        Storage::delete('course_images/' . $course->course_image);
        $course->delete();
        if(auth()->user()->type == 'admin'){
            return redirect()->route('admins.courses.index')->with('success', "Course has been deleted successfully");
        }elseif(auth()->user()->type == 'lecturer'){
            return redirect()->route('lecturers.courses.index')->with('success', "Course has been deleted successfully");
        }
    }

}
