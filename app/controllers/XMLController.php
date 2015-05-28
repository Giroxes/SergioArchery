<?php

class XMLController extends \BaseController {

    public function xml()
    {
        if (Input::hasFile('file')) {
            
            libxml_use_internal_errors(true);
            $xmlValidate = new DOMDocument();
            $xmlValidate->load(Input::file('file'));
            
            if($xmlValidate->schemaValidate('V:\test.xsd')) {
                $xmlFile = simplexml_load_file(Input::file('file'));
                try {
                    foreach ($xmlFile->children() as $categoria) {
                        $parentId = Category::firstOrCreate(array('name' => $categoria['name']))->id;

                        foreach ($categoria->subcategories->children() as $subcategoria) {
                            $categoria_id = Category::firstOrCreate([
                                'name' => $subcategoria['name'],
                                'parent_id' => $parentId
                            ])->id;

                            foreach ($subcategoria->products->children() as $producto) {
                                $prod = Product::firstOrCreate([
                                    'name' => $producto->name,
                                    'category_id' => $categoria_id
                                ])->fill((array)$producto);
                                $prod->save();
                            }
                        }
                    }
                    $message = "Archivo XML cargado con éxito.";
                    $type = 'info'; 
                } catch (ErrorException $exc) {
                    $message = $exc->getMessage();
                    $type = 'error'; 
                }
                               
            } else {
                $message = "Archivo XML mal formado";
                $type = 'error';
            }
        }
        return Redirect::back()->with([
            'message' => $message,
            'type' => $type
        ]);
    }
}