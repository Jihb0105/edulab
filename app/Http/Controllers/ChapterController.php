<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\LectureType;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\Facades\Vimeo;

class ChapterController extends Controller
{
    public function create($id)
    {
        $course = Course::findOrFail($id);
        $lecture_types = LectureType::orderBy('id')->pluck('lecture_type', 'id');
        return view('lecturers.chapters.create', compact('lecture_types','course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chapter_no' => 'required',
            'course_id' => 'required',
            'lecture_type_id' => 'required|exists:lecture_types,id',
            'title' => 'required|string|max:200',
            'overview' => 'required',
            // 'lecture' => 'required|file|mimes:mp3,wav,mp4,mov,mkv,pdf,txt',
        ]);

        $chapter = new Chapter();
        $chapter->chapter_no = $request->chapter_no;
        $chapter->course_id = $request->course_id;
        $chapter->lecture_type_id = $request->lecture_type_id;
        $chapter->title = $request->title;
        $chapter->overview = $request->overview;
        if ($request->lecture_type_id == 1) {
            $chapter->lecture = Vimeo::upload($request->lecture, [
                'name' => $request->title,
                'description' => $request->overview
            ]);
        }else{
            $lectureName = '';
            if ($request->hasFile('lecture')) {
                $lectureName = time().$request->file('lecture')->getClientOriginalName();
                $request->file('lecture')->storeAs('lectures', $lectureName, 'public');
            } else {
                $lectureName = $chapter->lecture;
            }
            $chapter->lecture = $lectureName;
        }
        
        $chapter->save();

        if (session('cEdit_url')) {
            return redirect(session('cEdit_url'));
        }else{
            return redirect()->route('lecturers.courses.index')->with('message', 'Chapter has been created successfully');
        }
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $lecture_types = LectureType::orderBy('id')->pluck('lecture_type', 'id');

        Session::put('chapterEdit_url', request()->fullUrl());

        if(auth()->user()->type == 'admin'){
            return view('admins.chapters.edit',compact('chapter','lecture_types'));
        }elseif(auth()->user()->type == 'lecturer'){
            return view('lecturers.chapters.edit',compact('chapter', 'lecture_types'));
        }
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'chapter_no' => 'required',
            'course_id' => 'required',
            'lecture_type_id' => 'required|exists:lecture_types,id',
            'title' => 'required|string|max:200',
            'overview' => 'required',
            // 'lecture' => 'nullable|file|mimes:mp3,wav,mp4,mov,mkv,pdf,txt',
        ]);

        $chapter->chapter_no = $request->chapter_no;
        $chapter->course_id = $request->course_id;
        $chapter->lecture_type_id = $request->lecture_type_id;
        $chapter->title = $request->title;
        $chapter->overview = $request->overview;

        if ($request->hasFile('lecture')) {
            if ($request->lecture_type_id == 1) {
                $video_id = $chapter->lecture;
                if (substr($video_id, 0, 7) == '/videos'){
                    $chapter->lecture = Vimeo::replace($video_id, $request->lecture, [
                        'name' => $request->title,
                        'description' => $request->overview
                    ]);
                }else{
                    Storage::delete('lectures/' . $chapter->lecture);
                    $chapter->lecture = Vimeo::upload($request->lecture, [
                        'name' => $request->title,
                        'description' => $request->overview
                    ]);
                }
            }else{
                $video_id = $chapter->lecture;
                if (substr($video_id, 0, 7) == '/videos'){
                    Vimeo::request($video_id, [], 'DELETE');
                    $lectureName = '';
                    if ($request->hasFile('lecture')) {
                        $lectureName = time().$request->file('lecture')->getClientOriginalName();
                        $request->file('lecture')->storeAs('lectures', $lectureName, 'public');
                    } else {
                        $lectureName = $chapter->lecture;
                    }
                    $chapter->lecture = $lectureName;
                }else{
                    $lectureName = '';
                    if ($request->hasFile('lecture')) {
                        $lectureName = time().$request->file('lecture')->getClientOriginalName();
                        $request->file('lecture')->storeAs('lectures', $lectureName, 'public');
                        Storage::delete('lectures/' . $chapter->lecture);
                    } else {
                        $lectureName = $chapter->lecture;
                    }
                    $chapter->lecture = $lectureName;
                }
                
            }   
        }
        $chapter->update();

        if (session('cEdit_url')) {
            return redirect(session('cEdit_url'))->with('message', 'Chapter has been updated successfully');
        }
    }

    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $lecture = $chapter->lecture;

        if(substr($lecture, 0, 7) == '/videos'){
            Vimeo::request($lecture, [], 'DELETE');
        }else{
            Storage::delete('lectures/' . $chapter->lecture);
        }
        
        $chapter->delete();

        if (session('cEdit_url')) {
            return redirect(session('cEdit_url'))->with('message', 'Chapter has been deleted successfully');
        }
    }

    public function backButton()
    {
        if (session('cEdit_url')) {
            return redirect(session('cEdit_url'));
        }
    }
}
