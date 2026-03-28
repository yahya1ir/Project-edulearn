<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'idea',
        'topics',
        'price',
        'color'
    ];
    
    protected $casts = [
        'topics' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Accessor to always return topics as array
    public function getTopicsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
    
    // Mutator to ensure topics is stored as JSON
    public function setTopicsAttribute($value)
    {
        $this->attributes['topics'] = json_encode($value);
    }
}