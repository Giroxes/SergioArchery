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
                "name" => "Perfexion Px2",
                "trademark" => 'Xpedition',
                "price" => 999.95,
                "discount" => 10,
                "category_id" => $poleas
             ],
            [
                "name" => "Ion Jet Black",
                "trademark" => 'Prime',
                "price" => 999.95,
                "discount" => 10,
                "category_id" => $poleas
             ],
            [
                "name" => "Super Kodiak",
                "trademark" => 'Bear',
                "price" => 499.95,
                "discount" => 10,
                "category_id" => $recurvado
             ],
            [
                "name" => "Swift",
                "trademark" => 'Great Plains',
                "price" => 889.95,
                "discount" => 10,
                "category_id" => $recurvado
             ],
            [
                "name" => "Carbon Express Maxima Blue Streak Select",
                "trademark" => 'Xpedition',
                "price" => 12.95,
                "discount" => 10,
                "category_id" => $carbono
             ]
         ];

         foreach ($products as $product)
         {
            Product::create($product);
         }
     }
}
