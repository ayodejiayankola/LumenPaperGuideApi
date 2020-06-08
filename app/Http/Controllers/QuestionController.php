<?php

namespace App\Http\Controllers;

use App\Question;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
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
     * Return a list of Question
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $questions = Question::all();
        return  $this->successResponse($questions);
    }
    /**
     * Obtain and show one new Question
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
        $question= Question::findorfail($id);
        return  $this->successResponse($question);


    }
    /**
     * create on new Question
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'question_no'=> 'required|max:100',
            'answers'=> 'required|max:30',
            'subject_id'=> 'required|min:1',

        ];
        $this->validate($request,$rules);
        $paper = Paper::create($request->all());
        return  $this->successResponse($paper, Response::HTTP_CREATED);


    }
    /**
     * create on existing Question
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'question_no'=> 'max:100',
            'answers'=> 'max:30',
            'subject_id'=> 'min:1',
        ];

        $this->validate($request, $rules);
        $status = Status::findOrFail($id);
        $status->fill($request->all());

        if($status->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $status->save();
        return $this->successResponse($id);


    }

    /**
     * Delete an existing Question
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $question=Question::findorfail($id);
        $question->delete();
        return  $this->successResponse($id);

    }
}
