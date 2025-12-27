<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;

    protected $table = 'category_attributes';
    
    protected $fillable = [
        'category_id',
        'attribute_name',
        'attribute_type',
        'is_required',
        'options',
        'sort_order',
    ];

    /**
     * Cast options column to array for select type attributes
     */
    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    /**
     * Relationship với Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Scope để lấy attributes theo category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)->orderBy('sort_order');
    }
}
