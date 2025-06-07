<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required|max:255',
        'caption' => 'nullable|max:1000',
        'keyword' => 'nullable|max:255',
        'creator' => 'nullable|max:255',
        'publisher' => 'nullable|max:255',
        'isbn' => 'nullable|digits:13',
        'image' => 'nullable|image'
    ];    
}
