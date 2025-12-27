<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'id', // category_id
        'brand_id',
        'product_name',
        'product_image',
        'product_price',
        'product_sale_price',
        'product_stock',
        'product_status',
        'product_description',
        'product_ingredient',
        'product_weight',
        'product_origin',
        'product_expiry',
        'specifications',
    ];

    /**
     * Cast specifications column to array automatically
     */
    protected $casts = [
        'specifications' => 'array',
    ];

    /**
     * Relationship với Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'id');
    }

    /**
     * Relationship với Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}
