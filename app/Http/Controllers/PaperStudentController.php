<?php

namespace App\Http\Controllers;

use App\Paper;
use App\PaperStudent;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


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
     * Obtain and show one new paperStudent
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
            $paperStudent= PaperStudent::findorfail($id);
            return  $this->successResponse($paperStudent);

    }
    /**
     * create on new paperStudent
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'student_id'=> 'required|min:1',
            'paper_id'=> 'required|min:1',
            'marked'=> 'required|max:1',
            'score'=> 'required|max:100',

        ];
        $this->validate($request,$rules);
        $guide= PaperStudent::create($request->all());
        $guide= PaperStudent::findorfail($guide['id']);
        $submission = Paper::findorfail($guide['student_id']);
        $results = array_map(function($guide, $submission){
            $result = array();
            $result['subject'] = $guide['subject'];
            $result['total_questions'] = count($guide['questions']);
            if(isset($submission)){
                $result['answered'] = count($submission['questions']);
                $result['score'] =  count(array_intersect($guide['answer'], $submission['answer']));
                $result['marked'] = 1;

            }else{
                $result['answered'] = 0;
                $result['score'] =  0;
            }
            $result['percentage'] = ($result['score']/$result['total_questions'])*100;
            $submission->save();
            $guide->save();
            return  $this->successResponse($guide, Response::HTTP_CREATED);
        },
            $this->markingGuide->storage, $this->studentSubmission->storage);

    }
    /**
     * create on existing paperStudent
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'student_id'=> 'min:1',
            'paper_id'=> 'min:1',
            'marked'=> 'max:1',
            'score'=> 'max:100',
        ];

        $this->validate($request, $rules);
        $paperStudent = PaperStudent::findOrFail($id);
        $paperStudent->fill($request->all());

        if($paperStudent->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $paperStudent->save();

        return $this->successResponse($id);


    }



    /**
     * Delete an existing
     * paperStudent
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $paperStudent = PaperStudent::findorfail($id);
        $paperStudent->delete();
        return $this->successResponse($id);

    }

    /**
     * Marking a student paper
     *
     * @return Illuminate\Http\Response
     */

    public function  markScript()
    {



    }

}
