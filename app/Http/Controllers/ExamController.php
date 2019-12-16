<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
const TOTAL_QUESTIONS = 30;

class ExamController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'role:0']);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //trying to match lecture id in database
        $lecture_id = $request->route('lecture_id');
        $lecture = \App\Lecture::findOrFail($lecture_id);
        
        //gets logged user's exams
        $exams = auth()->user()->exams->where('lecture_id', $lecture_id);
        if ($exams->first() && $exams->last()->is_done == 0){
            return view('exam.index', [
                'exam_id' => $exams->last()->id,
                'lecture_id' => $lecture_id,
                'lecture_name' => $lecture->name,
            ]);
        }
        //checks
        if ($exams->first() && $exams->last()->created_at > now()->subDays(1)->toDateTimeString()){
            return redirect('/lecture')->withErrors("Bu dersten daha fazla sınava giremezsiniz");
        }

        //adds exams to database
        $examCreated = \App\Exam::create([
            'user_id' => auth()->user()->id,
            'lecture_id' => $lecture_id,
        ]);
        //calculate answers
        $points = [];
        $counts = [];
        $temp = 0;
        $totalPoint = 0;
        $questionCount = TOTAL_QUESTIONS;
        foreach ($lecture->lessons as $lesson) {
            $points[$lesson->id]=0;
            $counts[$lesson->id]=0;
            $questionCount--;
        }
        //get the correct answers for each lesson
        foreach ($exams as $exam) {
            foreach ($exam->questions as $question){
                //increase question number for each exam
                $counts[$question->lesson->id] ++;
                if ($question->answers->where('exam_id', $exam->id)->first()->answer === $question->correct_answer){
                    //increase correct answers
                    $points[$question->lesson->id] ++;
                }
            }
        }
        //calculate points for each lesson
        foreach ($points as $key => $point) {
            //for divide 0 error
            if ($counts[$key] == 0) $counts[$key] = 1;
            //reconfigure points array
            $points[$key] = ($counts[$key] - $point)/$counts[$key];
            //total points for question distribution
            $totalPoint += $points[$key]; 
        }
        //calculate question numbers for each lesson
        foreach ($points as $key => $point) {
            //normalization by total question number
            $points[$key] *= ($questionCount/$totalPoint); 
            $points[$key] += $temp;//to deal with decimals
            $temp = $points[$key] - floor($points[$key]); 
            $points[$key] = floor($points[$key]);
            if($key === array_key_last($points)) {
                $points[$key] = round($points[$key]+$temp);
            }
            $points[$key]++;//adds 1 question for each lesson
            $questions = $lecture->lessons->find($key)->questions->random($points[$key]);
            $examCreated->questions()->attach($questions);
        }
        return view('exam.index', [
            'exam_id' => $examCreated->id,
            'lecture_id' => $lecture_id,
            'lecture_name' => $lecture->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
