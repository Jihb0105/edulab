<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Notifications\UserApprovedNotification;
use App\Notifications\UserRejectedNotification;

class ApprovalController extends Controller
{
    //User Management
    public function index()
    {
        $lecturers = User::orderBy('name', 'asc')->where(function ($query){
            if ($search = request()->query('search')) {
                $query->where("name", "LIKE", "%{$search}%");
            }
        })
        ->whereNot('id', 1)
        ->whereNot('type', 0)
        ->paginate(10);

        return view('admins.users.index', compact('lecturers'));
    }

    public function edit($id)
    {
        $lecturer = User::findOrFail($id);
        return view('admins.users.edit', compact('lecturer'));
    }

    public function downloadCV($id)
    {
        $lecturer = User::findOrFail($id);
        $lecturerCV = Storage::disk('public')->path('lecturer_cvs/'.$lecturer->lecturer_cv);
        return response()->download($lecturerCV);
    }

    public function approve(User $user)
    {
        $user->approved = 1;
        $user->save();

        $user->notify(new UserApprovedNotification($user));

        return redirect()->route('admins.users.index')->with('success', 'Instructor has been approved.');
    }

    public function reject(Request $request, User $user)
    {
        $user->approved = 2;
        $user->save(); 

        $user->notify(new UserRejectedNotification($user, $request->reject_reason));

        return redirect()->route('admins.users.index')->with('success', 'Instructor has been rejected.');

    }

}
