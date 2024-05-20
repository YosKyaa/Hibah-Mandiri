<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryResearch extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'category_name',
    ];
    public function field_fucus_research()
    {
        return $this->hasMany(FieldFocusResearch::class);
    } 
}
