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
			$existing = Table::where(array("name" => $request->get('name'), "project_id" => $request->get('project_id')))->get();
			
			if (count($existing) > 0)
				return Response::json(array('success' => false, 'output' => "Error: table already exists."), 200);

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
		$table = Table::find($id);

		//return $Table;
		// show the view and pass the Table to it 
		return View::make('view_table')->with('table', $table);
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
			$Table = Table::find($id);
			if (!$Table)
				return Response::json(array('success' => false, 'output' => "Table not found"), 410);

			$Table->name = $request->get('name');
			$Table->columns = json_encode($request->get('columns'));
			$Table->project_id = $request->get('project_id');
			$Table->save();

			Session::flash('message', 'Table updated.');
			return Response::json(array('success' => true), 200);
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
		// delete one Table 
		$Table = Table::find($id);

		$Table->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the table!');
		return Redirect::to('project/view/' . $Table->project_id);
    }
}
