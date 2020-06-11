<?php

namespace App\Http\Controllers;

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
        $paperStudent= PaperStudent::create($request->all());
        return  $this->successResponse($paperStudent, Response::HTTP_CREATED);
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
