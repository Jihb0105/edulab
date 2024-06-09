<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewUserNotification;

class LecturerController extends Controller
{
    public function lecturerDashboard()
    {
        $courses = Course::where('instructor_id', Auth::user()->id)->latest()->paginate(5);
        $coursesCount = Course::where('instructor_id', Auth::user()->id)->count();

        return view('lecturers.dashboard', compact('courses', 'coursesCount'));
    }

    public function registerLecturerView()
    {
        return view('lecturers.register');
    }

    public function registerLecturer(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:|confirmed',
            'birth_date' => 'required|date',
            'lecturer_cv' => 'required',
            'lecturer_description' => 'required|max:300'
        ]);

        $lecturer = new User();
        $lecturer->name = $request->name;
        $lecturer->email = $request->email;
        $lecturer->birth_date =  Carbon::parse($request->birth_date)->format('Ymd');
        $lecturer->password = Hash::make($request->password);
        $lecturer->type = $request->type;
        $lecturerCv = '';
        if ($request->hasFile('lecturer_cv')) {
            $lecturerCv = time().$request->file('lecturer_cv')->getClientOriginalName();
            $request->file('lecturer_cv')->storeAs('lecturer_cvs/', $lecturerCv, 'public');
        } else {
            $lecturerCv = $lecturer->lecturer_cv;
        }
        $lecturer->lecturer_cv = $lecturerCv;
        $lecturer->lecturer_description = $request->lecturer_description;
        $lecturer->save();
        
        $admin = User::where('type', 1)->first();
        if ($lecturer->type == 'lecturer') {
            $admin->notify(new NewUserNotification($lecturer));
        }

        return redirect()->route('login')->with('message', 'Waiting for Approval, Please Check Back Again.');
    }
}
