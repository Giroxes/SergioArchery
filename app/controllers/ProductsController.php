<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            if(!empty(Input::get('parentId'))) {
                $types = Category::find(Input::get('parentId'))->subcategories->lists('name', 'id');
            } else {
                $types = Category::find(Input::get('categoryId'))->subcategories->lists('name', 'id');
            }
            $data = [
                'categoryId' => Input::get('categoryId'),
                'types' => $types
            ];
            return View::make('admin/createProduct')->with($data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $producto = new Product(Input::all());
            $producto->price *= 100;
            $producto->discount *= 100;
            $producto->save();
            
            return Redirect::to('admin');
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
            $data = [
                'producto' => Product::find($id),
                'types' => Category::whereNotNull('parent_id')->lists('name', 'id')
            ];
            return View::make('admin/editProduct')->with($data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $producto = Product::findOrFail($id);
            $producto->fill(Input::all());
            $producto->price *= 100;
            $producto->discount *= 100;
            null == Input::get('home') ? $producto->home = false : '';
            $producto->save();
            
            return Redirect::to('admin');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            Product::destroy($id);
            return Redirect::to('admin');
	}

}
