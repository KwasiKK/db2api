<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Columns;
use View;
use Form;
use Validator;
use Input;
use Session;
use Redirect;

class ColumnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the Columnss 
		$Columns = Columns::all();

		// load the view and pass the Columnss 
		return View::make('Columns.index')->with('Columns', $Columns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// load the create form (app/views/Columns/create.blade.php) 
		return View::make('Columns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// validate input 
		$rules = array(
			'note' => 'required', 
			'aid_holder_id' => 'required', 
			'date' => 'required', 
		); 
		$validator = Validator::make(Input::all(), $rules);

		// process the validator
		if($validator->fails()){
			return Redirect::to('Columns/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store the data 
			$Columns = new Columns; 
			$Columns->note = Input::get('note');
			$Columns->aid_holder_id = Input::get('aid_holder_id');
			$Columns->date = Input::get('date');
			$Columns->save();

			// redirect
			Session::flash('message', 'Successfully created Columns!');
			return Redirect::to('Columns');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		// get one Columns 
		$Columns = Columns::find($id);

		// show the view and pass the Columns to it 
		return View::make('Columns.show')->with('Columns', $Columns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// get one Columns 
		$Columns = Columns::find($id);

		// show the view and pass the Columns to it 
		return View::make('Columns.edit')->with('Columns', $Columns);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// validate input 
		$rules = array(
			'note' => 'required', 
			'aid_holder_id' => 'required', 
			'date' => 'required', 
		); 
		$validator = Validator::make(Input::all(), $rules);

		// process the validator
		if($validator->fails()){
			return Redirect::to('Columns/'.$id.'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store the data 
			$Columns = Columns::find($id); 
			$Columns->note = Input::get('note');
			$Columns->aid_holder_id = Input::get('aid_holder_id');
			$Columns->date = Input::get('date');
			$Columns->save();

			// redirect
			Session::flash('message', 'Successfully updated Columns!');
			return Redirect::to('Columns');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		// delete one Columns 
		$Columns = Columns::find($id);

		$Columns->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the Columns!');
		return Redirect::to('Columns');
    }
}
