<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Table;
use View;
use Form;
use Session;
use Response;
use Validator;
use Redirect;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the Tables 
		$Table = Table::all();

		// load the view and pass the Tables 
		return View::make('Table.index')->with('Table', $Table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// load the create form (app/views/Table/create.blade.php) 
		return View::make('Table.create');
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
			'name' => 'required', 
			'columns' => 'required', 
			'project_id' => 'required', 
		); 

		$validator = Validator::make($request->all(), $rules);

		// process the validator
		if($validator->fails()){
			return Response::json(array('success' => false, 'output' => json_encode($validator->errors())), 200);
		} else {
			// store the data 
			$Table = new Table; 
			$Table->name = $request->get('name');
			$Table->columns = json_encode($request->get('columns'));
			$Table->project_id = $request->get('project_id');
			$Table->save();

			// redirect
			Session::flash('message', 'Table created.');
			return Response::json(array('success' => true), 200);
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
		// get one Table 
		$Table = Table::find($id);

		// show the view and pass the Table to it 
		return View::make('Table.show')->with('Table', $Table);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// get one Table 
		$Table = Table::find($id);

		// show the view and pass the Table to it 
		return View::make('Table.edit')->with('Table', $Table);
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
    	return $request;
		// validate input 
		$rules = array(
			'note' => 'required', 
			'aid_holder_id' => 'required', 
			'date' => 'required', 
		); 
		// $validator = Validator::make(Input::all(), $rules);

		// // process the validator
		// if($validator->fails()){
		// 	return Redirect::to('Table/'.$id.'/edit')
		// 		->withErrors($validator)
		// 		->withInput(Input::all());
		// } else {
			// store the data 
			// $Table = Table::find($id); 
			// $Table->note = Input::get('note');
			// $Table->aid_holder_id = Input::get('aid_holder_id');
			// $Table->date = Input::get('date');
			// $Table->save();

			// redirect
			// Session::flash('message', 'Successfully updated Table!');
			// return Redirect::to('Table');
		//}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		// delete one Table 
		$Table = Table::find($id);

		$Table->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the Table!');
		return Redirect::to('Table');
    }
}
