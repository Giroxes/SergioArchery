<?php

class ProductSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $recurvado = DB::table('categories')
                    ->select('id')
                    ->where('name', 'recurvados')
                    ->first()
                    ->id;
        $poleas = DB::table('categories')
                    ->select('id')
                    ->where('name', 'poleas')
                    ->first()
                    ->id;
        $carbono = DB::table('categories')
                    ->select('id')
                    ->where('name', 'carbono')
                    ->first()
                    ->id;
        
        
        
        $products = [
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "cvvvvv",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "xvbbb",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "xvbxxxak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "bndgh",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Sertyerty",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Sertyiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Sutyodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Superdfhd Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Scniak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Supewertk",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "bvnxvc",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "cxcvb",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "zxcvx",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "cvbxak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Scvnak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Supsdfher Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "Supdfg",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "asdf",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "asd",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "asd",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ],
            [
                "name" => "asd",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "weight" => 60,
                "length" => 68,
                "home" => false,
                "category_id" => $recurvado
             ]
         ];

         foreach ($products as $product)
         {
            Product::create($product);
         }
     }
}
