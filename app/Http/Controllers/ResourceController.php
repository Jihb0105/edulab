<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index($id)
    {
        $chapter = Chapter::findOrFail($id);
        $resources = Resource::where('chapter_id', $chapter->id)->paginate(10);
        
        Session::put('rIndex_url', request()->fullUrl());

        if(auth()->user()->type == 'lecturer'){
            return view('lecturers.resources.index', compact('chapter', 'resources'));
        }elseif(auth()->user()->type == 'admin'){
            return view('admins.resources.index', compact('chapter','resources'));
        }
    }

    public function create($id)
    {
        $chapter = Chapter::findOrFail($id);

        if (auth()->user()->type == 'lecturer') {
            return view('lecturers.resources.create', compact('chapter'));
        } elseif(auth()->user()->type == 'admin') {
            return view('admins.resources.create', compact('chapter'));
        }
        
    }

    public function store(Request $request, Chapter $chapter)
    {
        $request->validate([
            'chapter_id' => 'required',
            'resource' => 'required|file|mimes:mp3,wav,mp4,mov,mkv,pdf,doc,docx,txt,ppt,pptx',
        ]);

        $resource = new Resource();
        $resource->chapter_id = $request->chapter_id;
        $fileName = '';
        if ($request->hasFile('resource')) {
            $fileName = time().$request->file('resource')->getClientOriginalName();
            $request->file('resource')->storeAs('resources', $fileName, 'public');
        } else {
            $fileName = $resource->resource;
        }
        $resource->resource = $fileName;

        $resource->save();

        if (session('rIndex_url')) {
            return redirect(session('rIndex_url'))->with('message', 'Chapter resource has been added.');
        }  
    }

    public function edit($id)
    {
        $resource = Resource::findOrFail($id);

        if (auth()->user()->type == 'lecturer') {
            return view('lecturers.resources.edit',compact('resource'));
        } elseif(auth()->user()->type == 'admin') {
            return view('admins.resources.edit',compact('resource'));
        }
    }

    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'chapter_id' => 'required',
            'resource' => 'required|file|mimes:mp3,wav,mp4,mov,mkv,pdf,doc,docx,txt,ppt,pptx',
        ]);

        $resource->chapter_id = $request->chapter_id;
        $fileName = '';
        if ($request->hasFile('resource')) {
            $fileName = time().$request->file('resource')->getClientOriginalName();
            $request->file('resource')->storeAs('resources', $fileName, 'public');
            if ($resource->resource) {
                Storage::delete('resources/' . $resource->resource);
            }
        } else {
            $fileName = $resource->resource;
        }
        $resource->resource = $fileName;

        $resource->update();

        if (session('rIndex_url')) {
            return redirect(session('rIndex_url'))->with('message', 'Chapter resource has been added.');
        }  
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);
        Storage::delete('resources/' . $resource->resource);
        $resource->delete();

        if (session('rIndex_url')) {
            return redirect(session('rIndex_url'))->with('message', 'Chapter resource has been added.');
        } 
    }

    public function backButton()
    {
        if (session('chapterEdit_url')) {
            return redirect(session('chapterEdit_url'));
        } 
    }
}
