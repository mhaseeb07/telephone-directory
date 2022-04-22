<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $table = 'category';
    protected $fillable = [
        'name','slug','created_by','updated_by',
    ];
    protected $dates = ['deleted_at'];
}
