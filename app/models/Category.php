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
}