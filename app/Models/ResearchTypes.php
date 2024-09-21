<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchTypes extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'title',
        'total_founds'
    ];
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'research_types_id', 'id');
    }
    public function tktTypes()
    {
        return $this->hasMany(TktTypes::class, 'research_type_id', 'id');
    }
}
