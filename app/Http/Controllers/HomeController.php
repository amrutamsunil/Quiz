<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::where('role_id','=',2)->count();
        $quizzes = Test::count();
        $average = Test::avg('result');
        return view('home', compact('questions', 'users', 'quizzes', 'average'));
    }
    public function feedback(){
        $feedbacks=Test::with(['user','topic'])->where("feedback","!=","")->get();
        return view('feedback')->with('feedbacks',$feedbacks);

    }
}
