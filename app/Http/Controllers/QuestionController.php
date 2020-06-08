<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;


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

    }
    /**
     * Obtain and show one new Question
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){

    }
    /**
     * create on new Question
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){

    }
    /**
     * create on existing Question
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){

    }

    /**
     * Delete an existing Question
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){

    }
}
