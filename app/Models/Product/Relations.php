<?php


namespace App\Models\Product;


use App\Models\Attribute;
use App\Models\Category;
use App\Models\Label;
use App\Models\Manufacturer;

trait Relations
{
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'label_product');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
