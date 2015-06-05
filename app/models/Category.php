<?php

class Category extends Eloquent
{
    protected $table = "categories";
    protected $fillable = ['name', 'parent_id'];
    
    public function subcategories() {
        return $this->hasMany('Category','parent_id');
    }
    
    public function parent() {
        return $this->belongsTo('Category','parent_id','id');
    }
    
    public function products() {
        return $this->hasMany('Product','category_id');
    }
    
    public static function boot()
    {
        parent::boot();    

        static::deleted(function($category)
        {
            $subcategorias = $category->subcategories;
            $productos = $category->products;
            foreach($subcategorias as $subcategoria) {
                Category::destroy($subcategoria->id);
            }
            foreach($productos as $producto) {
                Product::destroy($producto->id);
            }
        });
    }
}