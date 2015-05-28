<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('admin/createCategory')->with('parentId', Input::get('parentId'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $rules = [
                "name" => "required|unique:categories"        
            ];

            $input = Input::only(
                "name"
            );

            $messages = array(
                'name.unique' => 'La categoría ya existe.',
            );

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $parentId = Input::get('parentId') ? Input::get('parentId') : null;
            
            Category::create([
                'name' => strtolower(Input::get('name')),
                'parent_id' => $parentId
            ]);
            
            $message = "Categoría creada correctamente";
            $type = 'info';
            return Redirect::to('admin')->with([
                'message' => $message,
                'type' => $type
            ]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            return View::make('admin/editCategory')->with('categoria', Category::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $rules = [
                "name" => "required|unique:categories"        
            ];

            $input = Input::only(
                "name"
            );

            $messages = array(
                'name.unique' => 'La categoría ya existe.',
            );

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $categoria = Category::findOrFail($id);
            $categoria->fill(Input::all());
            $categoria->save();
            
            $message = "Categoría actualizada correctamente";
            $type = 'info';
            return Redirect::to('admin')->with([
                'message' => $message,
                'type' => $type
            ]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            Category::destroy($id);
            
            $message = "Categoría eliminada correctamente";
            $type = 'info';
            return Redirect::to('admin')->with([
                'message' => $message,
                'type' => $type
            ]);
	}

}
