<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\JobTitle;
use App\Models\Resource;
use App\Models\Question;
use App\Models\Enrollment;
use App\Models\Watchlist;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function terms()
    {
        return view('users.terms');
    }

    public function privacy()
    {
        return view('users.privacy');
    }

    public function showWelcome()
    {
        $newArrivalCourses = Course::orderBy('id', 'desc')->paginate(8);
        return view('welcome', compact('newArrivalCourses'));
    }

    public function getSingleCategory($id)
    {
        $category = Category::findOrFail($id);
        $courses = Course::orderBy('title', 'asc')->where('category_id', $category->id)->paginate(10);

        return view('users.category', compact('category', 'courses'));    
    }

    public function showCourse($id)
    {
        $course = Course::findOrFail($id);
        $chapters = Chapter::orderBy('chapter_no', 'asc')->where('course_id', Course::findOrFail($id)->id)->paginate(5);
        $job_titles = JobTitle::orderBy('job_title','asc')->where('instructor_id', Course::findOrFail($id)->instructor_id)->get();    
        // Get all ratings
        $ratings = Rating::with('user')->where('course_id', $course->id)->orderBy('id', 'desc')->get();
        // Find average ratings
        $ratingsSum = Rating::where('course_id', $course->id)->sum('rating');
        $ratingCount = Rating::where('course_id', $course->id)->count();

        if ($ratingCount > 0) {
            $avgRating = round($ratingsSum/$ratingCount, 2);
            $avgStarRating = round($ratingsSum/$ratingCount);
        } else {
            $avgRating = 0;
            $avgStarRating = 0;
        }

        if (empty(auth()->user()->id)){
            return view('users.course', compact('course', 'job_titles', 'chapters', 'ratings', 'avgRating', 'avgStarRating', 'ratingCount'));
        }else{
            $eRecord = Enrollment::where('course_id', '=', $course->id)
            ->where('student_id', '=', auth()->user()->id)
            ->first();
    
            $wRecord = Watchlist::where('course_id', '=', $course->id)
            ->where('student_id', '=', auth()->user()->id)
            ->first();

            return view('users.course', compact('course', 'job_titles', 'chapters', 'eRecord', 'wRecord', 'ratings', 'avgRating', 'avgStarRating', 'ratingCount'));
        }
    }

    public function showChapter($id)
    {
        $chapter = Chapter::findOrFail($id);
        $allChapters = Chapter::orderBy('chapter_no', 'asc')->where('course_id', Chapter::findOrFail($id)->course_id)->get();

        $quizRecord = Question::where('chapter_id', $chapter->id)->first();

        return view('users.chapter',compact('chapter', 'allChapters', 'quizRecord'));
    }

    public function downloadFile($id)
    {
        $resource = Resource::findOrFail($id);
        $file = Storage::disk('public')->path('resources/'.$resource->resource);
        return response()->download($file);
    }

    public function showResource($id)
    {
        $chapter = Chapter::findOrFail($id);
        $allChapters = Chapter::orderBy('chapter_no', 'asc')->where('course_id', $chapter->course_id)->get();
        $resources = Resource::orderBy('id', 'asc')->where('chapter_id', $chapter->id)->paginate(10);
        $quizRecord = Question::where('chapter_id', $chapter->id)->first();

        return view('users.resource', compact('chapter','allChapters','resources','quizRecord'));
    }

    public function enrollment(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'student_id' => 'required',
        ]);

        $enrollment = new Enrollment();
        $enrollment->course_id = $request->course_id;
        $enrollment->student_id = $request->student_id;
        $enrollment->enrollment_date = \Carbon\Carbon::now();

        // Check for record existence.
        $record = DB::table('enrollments')
            ->where('course_id', '=', $enrollment->course_id)
            ->where('student_id', '=', $enrollment->student_id)
            ->first();

        if ($record === null) {
            $enrollment->save();
            return redirect()->route('users.getEnrolled')->with('message', 'User enrolled to this course.');
        } else {
            $record = DB::table('enrollments')
                ->where('course_id', '=',  $enrollment->course_id)
                ->where('student_id', '=', $enrollment->student_id)
                ->delete();
            return redirect()->back()->with('message', 'User removed from this course.');
        }
    }

    //watchlist
    public function watchlist(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'student_id' => 'required',
        ]);

        $watchlist = new Watchlist();
        $watchlist->course_id = $request->course_id;
        $watchlist->student_id = $request->student_id;

        // Check for record existence.
        $record = DB::table('watchlists')
            ->where('course_id', '=', $watchlist->course_id)
            ->where('student_id', '=', $watchlist->student_id)
            ->first();

        if ($record === null) {
            $watchlist->save();
            return redirect()->route('users.getWatchlist')->with('message', 'User enrolled to this course.');
        } else {
            $record = DB::table('watchlists')
                ->where('course_id', '=',  $watchlist->course_id)
                ->where('student_id', '=', $watchlist->student_id)
                ->delete();
            return redirect()->back()->with('message', 'User removed from this course.');
        }
    }

    public function showQuiz($id)
    {
        $chapter = Chapter::findOrFail($id);

        Session::put('nextq', '1');
        Session::put('wrongans', '0');
        Session::put('correctans', '0');

        $question = Question::where('chapter_id', $chapter->id)->first();

        return view('users.quizzes.startQuiz', compact('chapter','question'));
    }

    public function submitAns(Request $request, $id)
    {
        $request->validate([            
            'answer' => 'required',
            'dbans' => 'required',
        ]);

        $nextq = Session::get('nextq');
        $wrongans = Session::get('wrongans');
        $correctans = Session::get('correctans');

        $nextq+=1;

        if($request->dbans == $request->answer){
            $correctans+=1;
        }else{
            $wrongans+=1;
        }

        Session::put('nextq', $nextq);
        Session::put('wrongans', $wrongans);
        Session::put('correctans', $correctans);
    
        $i = 0;
        $chapter = Chapter::findOrFail($id);
        $questions = Question::where('chapter_id', $chapter->id)->get();

        foreach ($questions as $question)
        {
            $i++;
           if($questions->count() < $nextq)
           {
                return view('users.quizzes.endQuiz', compact('chapter'));
           } 

           if($i==$nextq)
           {
                return view('users.quizzes.startQuiz', compact('chapter'))->with(['question'=>$question]);
           }
        }
    }

    public function addRating(Request $request)
    {

        if($request->isMethod('post')){
            if(!Auth::check()){
                return redirect()->back()->with('message', "Login to rate Course");
            }
            if(!isset($request->rating)){
                return redirect()->back()->with('message', "Add at least one star rating for this course");
            }

            $ratingCount = Rating::where('user_id', Auth()->user()->id)->where('course_id', $request->course_id)->count();
            
            if($ratingCount > 0) {
                return redirect()->back()->with('message', "Your rating already exists for this Course");
            }else{
                $rating = new Rating();
                $rating->user_id = auth()->user()->id;
                $rating->course_id = $request->course_id;
                $rating->review = $request->review;
                $rating->rating = $request->rating;

                $rating->save();
                
                return redirect()->back()->with('message', "You have rated this course");
            }
        }
    }

    public function showDiscussion($id)
    {
        $chapter = Chapter::findOrFail($id);
        $allChapters = Chapter::orderBy('chapter_no', 'asc')->where('course_id', $chapter->course_id)->get();
        $quizRecord = Question::where('chapter_id', $chapter->id)->first();

        $chapterComments = $chapter->comments()->paginate(5);

        return view('users.discussion', compact('chapter','allChapters','quizRecord','chapterComments'));
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->chapter_id = $request->chapter_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('message', 'Comment added');
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->chapter_id = $request->chapter_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('message', 'Reply added');
    }
}
