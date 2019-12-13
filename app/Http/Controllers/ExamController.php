<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Lecture;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $lecture = \App\Lecture::findOrFail($request->lecture);
        $exams = auth()->user()->exams;
        if (!$request->lecture || !($exams->last()->lecture->exists() && $exams->last()->lecture !== $request->lecture)){
            return redirect('/');
        }
        if ($exams->where('lecture_id', $request->lecture)->where('created_at', '<', now()->subDays(1)->toDateTimeString())->first()=== null){
            return redirect('/lecture')->withErrors("Bu dersten daha fazla sınava giremezsiniz");
        }
        /* $exam = \App\Exam::create([
            'user_id' => auth()->user()->id,
            'lecture_id' => $request->lecture,
        ]); */
        
        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
