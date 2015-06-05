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
            $rules = [
                "name" => "required|unique:products"        
            ];

            $input = Input::only(
                "name"
            );

            $messages = array(
                'name.unique' => 'El producto ya existe.',
            );

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $image = Input::file('image');
            
            $producto = new Product(Input::all());
            $producto->price *= 100;
            $producto->discount *= 100;
            $producto->save();            
            $image->move('images/products', '(' . $producto->id . ')' . $image->getClientOriginalName());
            $producto->image = '(' . $producto->id . ')' . $image->getClientOriginalName();
            $producto->save();            
            
            $message = "Producto creado correctamente";
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
	    $producto = Product::find($id);
            if (!$producto) {
                App::abort(404);
            }
            return View::make('products/singleProduct', ['producto' => $producto]);
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
            $rules = [
                "name" => "required"        
            ];

            $input = Input::only(
                "name"
            );

            $messages = array(
                'name.unique' => 'El producto ya existe.',
            );

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $producto = Product::findOrFail($id);
            $producto->fill(Input::all());
            $producto->price *= 100;
            $producto->discount *= 100;
            null == Input::get('home') ? $producto->home = false : '';
            
            if (Input::file('image')) {
                File::delete(public_path() . '/images/products/' . $producto->image);
                $image = Input::file('image');
                $image->move('images/products', '(' . $producto->id . ')' . $image->getClientOriginalName());
                $producto->image = '(' . $producto->id . ')' . $image->getClientOriginalName();
            }
            $producto->save();
            
            $message = "Producto actualizado correctamente";
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
            File::delete(public_path() . '/images/products/' . Product::find($id)->first()->image);
            Product::destroy($id);
            
            $message = "Producto eliminado correctamente";
            $type = 'info';
            return Redirect::to('admin')->with([
                'message' => $message,
                'type' => $type
            ]);
	}

}
