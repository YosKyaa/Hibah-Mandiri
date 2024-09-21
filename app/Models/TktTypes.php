<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TktTypes extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'title',
        'research_type_id'
    ];

    public function researchType()
    {
        return $this->belongsTo(ResearchTypes::class, 'research_type_id');
    }
}
