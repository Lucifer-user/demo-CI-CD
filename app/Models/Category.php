<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_sl',
        'category_satus',
        'ngay_tao',
    ];

    /**
     * Relationship với CategoryAttribute
     */
    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class, 'category_id', 'id');
    }

    /**
     * Relationship với Sanpham
     */
    public function products()
    {
        return $this->hasMany(Sanpham::class, 'id', 'id');
    }
}
