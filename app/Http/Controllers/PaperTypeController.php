<?php

namespace App\Http\Controllers;

use App\PaperType;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class PaperTypeController extends Controller
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
     * Return a list of paperType
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $paperType = PaperType::all();
        return  $this->successResponse($paperType);    }
    /**
     * Obtain and show one new paperType
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
            $paperType= PaperType::findorfail($id);
            return  $this->successResponse($paperType);
    }
    /**
     * create on new paperType
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'name'=> 'required|max:30',

        ];
        $this->validate($request,$rules);
        $paperType = PaperType::create($request->all());
        return  $this->successResponse($paperType, Response::HTTP_CREATED);


    }
    /**
     * create on existing paperType
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'name'=> 'required|max:30',
        ];

        $this->validate($request, $rules);
        $paperType = PaperType::findOrFail($id);
        $paperType->fill($request->all());

        if($paperType->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $paperType->save();
        return $this->successResponse($id);
    }

    /**
     * Delete an existing paperType
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $paperType=PaperType::findorfail($id);
        $paperType->delete();
        return  $this->successResponse($id);

    }
}
