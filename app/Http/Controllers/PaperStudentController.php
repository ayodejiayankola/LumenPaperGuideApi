<?php

namespace App\Http\Controllers;

use App\Paper;
use App\PaperStudent;
use App\Question;
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
     * create a specific marking guide
     *
     * @return Illuminate\Http\Response
     */

    public function  getMarkingGuide($id){
        $paperStudent= Paper::findorfail($id);
        return  $this->successResponse($paperStudent);
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
    public function getStudentSubmission( $id){
        $studentSubmission = PaperStudent::findorfail($id);
        return  $this->successResponse($studentSubmission );



    }

    /**
     * mark script
     *
     * @return Illuminate\Http\Response
     */

    public function markStudentPaper(){

        $submission= $this->getStudentSubmission();
        $guide= $this->getMarkingGuide();
        if($submission){
            $result['answered'] = count($submission['questions']);
            $result['score'] =  count(array_intersect($guide['answer'], $submission['answer']));
            $result['marked'] = 1;
        }else{
            $result['answered'] = 0;
            $result['score'] =  0;
            $result['marked'] = 0;
        }
        $result['percentage'] = ($result['score']/$result['total_questions'])*100;
        $submission->save();
        $guide->save();
        return  $this->successResponse($guide, Response::HTTP_CREATED);



    }

    public function deleteStudentResult($id){
        $paper= PaperStudent::findorfail($id);
        $paper->delete();
        return $this->successResponse($id);

    }







}
