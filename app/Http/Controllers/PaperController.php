<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class PaperController extends Controller
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
     * Return a list of papers
     *
     * @return Illuminate\Http\Response
     */
    public function index(){

    }
    /**
     * Obtain and show one new paper
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){

    }
    /**
     * create on new paper
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){

    }
    /**
     * create on existing paper
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){

    }

    /**
     * Delete an existing paper
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){

    }
}
