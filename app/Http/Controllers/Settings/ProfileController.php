<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobTitle;
use App\Models\Course;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function uEdit()
    {
        $user = auth()->user();

        return view('users.profile',compact('user'));    
    }

    public function lEdit()
    {
        $user = auth()->user();
        $job_titles = JobTitle::orderBy('job_title', 'asc')->where('instructor_id', auth()->user()->id)->paginate(10);

        Session::put('lProfileEdit_url', request()->fullUrl());

        return view('lecturers.profiles.profile',compact('user', 'job_titles'));    
    }

    public function uUpdate(Request $request)
    {
        // Validate input.
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'birth_date' => 'required|date',
            'description' => 'nullable'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $imageName = '';
        if ($request->hasFile('profile_picture')) {
            $imageName = time().$request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            if ($user->profile_picture) {
                Storage::delete('profile_pictures/' . $user->profile_picture);
            }
        } else {
            $imageName = $user->profile_picture;
        }
        $user->profile_picture = $imageName;
        $user->birth_date = $request->birth_date;
        $user->description = $request->description;

        $user->update();
        return back()->with('message', "User profile has been updated successfully");
    }
    
    public function lUpdate(Request $request)
    {
        // Validate input.
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'birth_date' => 'required|date',
            'description' => 'nullable'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $imageName = '';
        if ($request->hasFile('profile_picture')) {
            $imageName = time().$request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            if ($user->profile_picture) {
                Storage::delete('profile_pictures/' . $user->profile_picture);
            }
        } else {
            $imageName = $user->profile_picture;
        }
        $user->profile_picture = $imageName;
        $user->birth_date = $request->birth_date;
        $user->description = $request->description;

        $user->update();
        return back()->with('message', "User profile has been updated successfully");
    }

    public function destroy()
    {
        $user = auth()->user();
        Storage::delete('profile_pictures/' . $user->profile_picture);
        Storage::delete('lecturer_cvs/' . $user->lecturer_cv);
        $user->delete();

        return redirect()->route('login')->with('message', "User has been deleted successfully");
    }

    // Job Title
    public function createJobTitle($id)
    {
        // $job_title = JobTitle::findOrFail($id);
        return view('lecturers.profiles.create_job_title');
    }

    public function storeJobTitle(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required',
            'job_title' => 'required|string|max:50',
        ]);

        $job_title = new JobTitle();
        $job_title->instructor_id = $request->instructor_id;
        $job_title->job_title = $request->job_title;

        $job_title->save();

        if (session('lProfileEdit_url')) {
            return redirect(session('lProfileEdit_url'))->with('message', 'Job Title has been created successfully');
        }else{
            return redirect()->route('lecturers.dashboard')->with('message', 'Job Title has been created successfully');
        }
    }

    public function editJobTitle($id)
    {
        $job_title = JobTitle::findOrFail($id);

        return view('lecturers.profiles.edit_job_title',compact('job_title'));
    }

    public function updateJobTitle(Request $request, JobTitle $job_title)
    {
        $request->validate([
            'instructor_id' => 'required',
            'job_title' => 'required|string|max:50',
        ]);

        $job_title->instructor_id = $request->instructor_id;
        $job_title->job_title = $request->job_title;

        $job_title->save();

        if (session('lProfileEdit_url')) {
            return redirect(session('lProfileEdit_url'))->with('message', 'Job Title has been updated successfully');
        }else{
            return redirect()->route('lecturers.dashboard')->with('message', 'Job Title has been updated successfully');
        }
    }

    public function destroyJobTitle($id)
    {
        $job_title = JobTitle::findOrFail($id);
        $job_title->delete();

        if (session('lProfileEdit_url')) {
            return redirect(session('lProfileEdit_url'))->with('message', 'Job Title has been updated successfully');
        }else{
            return redirect()->route('lecturers.dashboard')->with('success', "Job Title has been deleted successfully");
        }
    }

    public function getEnrollment()
    {
        $student_id = auth()->user()->id;
        
        $enrolled_id = DB::table('enrollments')
            ->where('student_id', '=', $student_id)
            ->get()
            ->map(function ($enrollment) {
                return strtoupper($enrollment->course_id);
            });
        
        $courses = Course::findOrFail($enrolled_id);

        return view('users.enrollment', compact('courses'));
    }

    public function getWatchlist()
    {
        $student_id = auth()->user()->id;

        $watchlist_id = DB::table('watchlists')
            ->where('student_id', '=', $student_id)
            ->get()
            ->map(function ($watchlist) {
                return strtoupper($watchlist->course_id);
            });
        
        $courses = Course::findOrFail($watchlist_id);

        return view('users.watchlist', compact('courses'));
    }
}
