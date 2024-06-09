<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Chapter;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function index($id)
    {
        $chapter = Chapter::findOrFail($id);
        $questions = Question::orderBy('question_no', 'asc')->where('chapter_id', $chapter->id)->paginate(20);

        Session::put('qIndex_url', request()->fullUrl());

        if(auth()->user()->type == 'lecturer'){
            return view('lecturers.quizzes.question', compact('chapter', 'questions'));
        }elseif(auth()->user()->type == 'admin'){
            return view('admins.quizzes.question', compact('chapter','questions'));
        }    
    }

    public function store(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required',
            'question_no' => 'required',
            'question' => 'required|string',
            'a' => 'required|string|max:100',
            'b' => 'required|string|max:100',
            'c' => 'required|string|max:100',
            'd' => 'required|string|max:100',
            'answer' => 'required|string|max:100',
        ]);

        $question = new Question();
        $question->chapter_id = $request->chapter_id;
        $question->question_no = $request->question_no;
        $question->question = $request->question;
        $question->a = $request->a;
        $question->b = $request->b;
        $question->c = $request->c;
        $question->d = $request->d;
        $question->answer = $request->answer;

        $question->save();

        if (session('qIndex_url')) {
            return redirect(session('qIndex_url'));
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        if(auth()->user()->type == 'lecturer'){
            return view('lecturers.quizzes.edit', compact('question'));
        }elseif(auth()->user()->type == 'admin'){
            return view('admins.quizzes.edit', compact('question'));
        } 
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'chapter_id' => 'required',
            'question_no' => 'required',
            'question' => 'required|string',
            'a' => 'required|string|max:100',
            'b' => 'required|string|max:100',
            'c' => 'required|string|max:100',
            'd' => 'required|string|max:100',
            'answer' => 'required|string|max:100',
        ]);

        $question->chapter_id = $request->chapter_id;
        $question->question_no = $request->question_no;
        $question->question = $request->question;
        $question->a = $request->a;
        $question->b = $request->b;
        $question->c = $request->c;
        $question->d = $request->d;
        $question->answer = $request->answer;

        $question->update();
        
        if (session('qIndex_url')) {
            return redirect(session('qIndex_url'));
        }
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        if (session('qIndex_url')) {
            return redirect(session('qIndex_url'));
        } 
    }

    public function startQuiz($id)
    {
        // Session::put('nextq', '1');
        // Session::put('wrongans', '0');
        // Session::put('correctans', '0');
        // $question = Question::all()->first();
        
        $chapter = Chapter::findOrFail($id);
        // $question = Question::where('chapter_id', $chapter->id)->get();

        // return view('users.quizzes.startQuiz')->with(['question'=>$question]);
        return view('users.quizzes.startQuiz', compact('question', 'chapter'));
    }

    public function backButton()
    {
        if (session('chapterEdit_url')) {
            return redirect(session('chapterEdit_url'));
        } 
    }
}
