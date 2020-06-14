<?php

namespace App\Http\Controllers;

use App\Paper;
use App\Question;
use App\PaperStudent;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class PaperStudentController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return a list of paperStudent
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $paperStudents = PaperStudent::all();
        return  $this->successResponse($paperStudents);
    }
    /**
     * get a specific marking guide
     *
     * @return Illuminate\Http\Response
     */
    public function markingGuides(){
        return $this->successResponse($this->getQuestions(Paper::TYPE_GUIDE));
    }

    /**
     * get a specific student submission
     *
     * @return Illuminate\Http\Response
     */
    public function submissions(){
        return $this->successResponse($this->getQuestions(Paper::TYPE_SUBMISSION));
    }
    /**
     * store a student submission
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'student_id'=> 'required|min:1',
            'paper_id'=> 'required|min:1',
        ];
        $this->validate($request,$rules);
        $paper = PaperStudent::create($request->all());
        return  $this->successResponse($paper, Response::HTTP_CREATED);
    }
    /**
     * get specific question
     *
     * @return Illuminate\Http\Response
     *

    private function getQuestions($type){
        return Paper::where('paper_type', $type)->firstorfail()->questions;
    }


    /**
     * mark script
     *
     * @return Illuminate\Http\Response
     */
    private function mark($student_id, $question_id){
        $paper = Paper::where('paper_type', Paper::TYPE_SUBMISSION)->firstorfail();
        $guides =  $this->getQuestions(Paper::TYPE_GUIDE);
        $submissions =  $this->getQuestions(Paper::TYPE_SUBMISSION);
        $correct = 0;

        foreach($submissions as $submission){
            if($submission->is_answer_correct){
                $correct++;
            }
        }
        $score = ($correct/$guides->count())*100;

        return  $paper->paperStudent()->create([
            'student_id' => $student_id,
            'question_id' => $question_id,
            'marked' => true,
            'score' => $score
        ]);
    }

    public function deleteStudentRecord($id){
        $paper= PaperStudent::findorfail($id);
        $paper->delete();
        return $this->successResponse($id);

    }


}
